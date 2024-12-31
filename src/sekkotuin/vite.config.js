import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
	plugins: [
		laravel({
			input: 'resources/js/app.ts',
			refresh: true,
		}),
		vue({
			template: {
				transformAssetUrls: {
					base: null,
					includeAbsolute: false,
				},
			},
		}),
	],
	server: {
		host: '0.0.0.0',
		watch: {
			usePolling: true,
		},
		port: 5173,
	},
});
