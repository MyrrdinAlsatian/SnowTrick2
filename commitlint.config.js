module.exports = {
    extends: ['@commitlint/config-conventional'],
    rules: {
        'type-enum': [
            2,
            'always',
            [
                '[โจ feat]',
                '[๐ง WIP]',
                '[๐ fix]',
                '[๐ release]',
                '[๐๏ธ critical fix]',
                '[๐ docs]',
                '[๐จ styles]',
                '[โป๏ธ refactor]',
                '[๐ perf]',
                '[๐งช test]',
                '[๐ท build]',
                '[๐๏ธ archi]',
                '[โ๏ธ ci]',
                '[๐ chores]',
                '[๐ merge]',
                '[๐ฑ assets]',
                '[โช๏ธ revert]',
                '[๐ clean]',
            ],
        ],
    },
};

