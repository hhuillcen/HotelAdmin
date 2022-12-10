module.exports = {
    mode: 'jit',
    purge: [
        './resources/views/admin/**/*.blade.php',
        './resources/views/admin/**/*.blade.php',
        './resources/views/admin/**/*.blade.php',
        './resources/views/componentes/**/*.blade.php',
        './resources/views/layouts/**/*.blade.php',
        './resources/views/vendor/**/*.blade.php',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {},
    },
    variants: {
        extend: {
            backgroundColor: ['checked'],
            borderColor: ['checked'],
        }
    },
    plugins: [],

}
