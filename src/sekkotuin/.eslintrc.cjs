/* eslint-env node */
require('@rushstack/eslint-patch/modern-module-resolution');

module.exports = {
	env: {
		node: true,
		commonjs: true,
	},
	extends: [
		'eslint:recommended',
		'plugin:@typescript-eslint/recommended',
		'plugin:vue/vue3-recommended',
		'standard',
	],
	parserOptions: {
		parser: '@typescript-eslint/parser',
		sourceType: 'module',
	},
	rules: {
		// warn rule
		'no-unused-vars': 'warn',
		'@typescript-eslint/no-unused-vars': 'warn',
		'vue/no-unused-vars': 'warn',
		'require-await': 'warn',
		'no-unreachable': 'warn',

		// ignore rule
		'vue/multi-word-component-names': 'off',
		'vue/no-multiple-template-root': 'off',
		'vue/no-v-model-argument': 'off',

		// prettier rule
		quotes: ['warn', 'single'],
		'comma-dangle': ['warn', 'only-multiline'],
		indent: ['error', 2, { SwitchCase: 1 }],
		'linebreak-style': ['error', 'unix'],
		semi: ['error', 'never'],
		'@typescript-eslint/member-delimiter-style': [
			'error',
			{
				multiline: { delimiter: 'none', requireLast: true },
				singleline: { delimiter: 'comma', requireLast: false },
				multilineDetection: 'brackets',
			},
		],
		'vue/max-attributes-per-line': [
			'error',
			{
				singleline: { max: 5 },
				multiline: { max: 1 },
			},
		],
	},
};
