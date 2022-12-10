<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Room;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $room_id = Room::whereRaw('UNACCENT(UPPER(name)) iLIKE UNACCENT(UPPER(?))', '%' . $request->get('query') . '%')->first();
        if (is_null($room_id)) {
            return response()->view('admin.invoices.index', [
                'invoices' => Invoice::where('created_at', 'like', '%' . $request->get('query') . '%')
                    ->paginate(10),
            ]);
        } else {
            return response()->view('admin.invoices.index', [
                'invoices' => Invoice::where('room_id', 'like', '%' . $room_id->id . '%')
                    ->orWhere('created_at', 'like', '%' . $request->get('query') . '%')
                    ->paginate(9999),
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->has('room')) {
            $room = Room::find($request->get('room'));
            return response()->view('admin.invoices.create', compact('room'));
        } else {
            return redirect()->route('admin.rooms.index')->with('status', 'Por favor seleccione una sala');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInvoiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreInvoiceRequest $request)
    {
        $validated = $request->validated();
        $invoice = new Invoice();
        $invoice->room_id = $request->room_id;
        $invoice->entry_time = $request->entry_time;
        $invoice->exit_time = $request->exit_time;
        $invoice->save();

        $room = Room::find($request->room_id);
        $room->status = $request->room_status;
        $room->entry_time = $request->entry_time;
        $room->exit_time = $request->exit_time;
        $room->save();

        return redirect()->route('admin.invoices.edit', $invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Invoice $invoice
     */
    public function show(Invoice $invoice)
    {
        header("Content-type:application/pdf");
        $foods = Item::where('type', 'food')->get();
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setIsHtml5ParserEnabled(true);
        $options->setDefaultFont('Courier');
        $dompdf->setOptions($options);
        $dompdf->loadHtml((string)view('admin.invoices.show', compact('invoice', 'foods')));
        $dompdf->setPaper([0, 0, 204.094, 841.89], 'portrait');

        $dompdf->render();

        return $dompdf->stream("document.pdf", array("Attachment" => false));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Invoice $invoice
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice, Request $request)
    {
        $movies = Item::where('type', 'movie')
            ->where(function ($query) use ($request) {
                $query->whereRaw('UNACCENT(UPPER(name)) iLIKE UNACCENT(UPPER(?))', '%' . $request->get('query') . '%')
                    ->orWhereRaw('UNACCENT(UPPER(description)) iLIKE UNACCENT(UPPER(?))', '%' . $request->get('query') . '%');
            })
            ->paginate(6);
        $foods = Item::where('type', 'food')->get();
        $slots = Item::where('type', 'slot')->get();
        return response()->view('admin.invoices.edit', compact('invoice', 'foods', 'slots', 'movies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        $validated = $request->validated();
        $invoice->status = $request->status;
        $invoice->description = $request->description;
        $invoice->price = $request->price;
        $invoice->save();
        return back()->with('status', 'Editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
