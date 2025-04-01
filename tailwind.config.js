import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		 './storage/framework/views/*.php',
		 './resources/**/*.blade.php',
		 './resources/**/*.js',
		 './resources/**/*.vue',
		 "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
         "./src/**/*.{html,js}",
         './app/Livewire/**/*Table.php',
         './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
         './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php'
	],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // "pg-primary": colors.gray, 
            },
        },
    },
    plugins: [
		require("daisyui")
	],
    presets: [
        require("./vendor/power-components/livewire-powergrid/tailwind.config.js"), 
	],
};
