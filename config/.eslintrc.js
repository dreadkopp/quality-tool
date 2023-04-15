module.exports = {
    root:          true,
    env:           {
        browser: true,
        es2020:  true,
        node:    true,
    },
    parser:        'vue-eslint-parser',
    parserOptions: {
        parser:      '@typescript-eslint/parser',
        sourceType:  'module',
        ecmaVersion: 2020,
    },
    plugins:       ['@typescript-eslint', 'prettier'],
    extends:       [
        'plugin:vue/vue3-essential',
        'eslint:recommended',
        '@vue/typescript/recommended',
        'plugin:prettier/recommended',
    ],
    rules:         {
        'no-console':        process.env.NODE_ENV === 'production' ? 'warn' : 'off',
        'no-debugger':       process.env.NODE_ENV === 'production' ? 'warn' : 'off',
        'prettier/prettier': process.env.NODE_ENV === 'production' ? 'off' : 'warn',
    },
    overrides:     [
        {
            files: ['**/tests/ts/**/*.spec.ts'],
            env:   {
                jest: true,
            },
        },
    ],
};
