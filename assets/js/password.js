var password = {
    // Add another object to the rules array here to add rules.
    // They are executed from top to bottom, with callbacks in between if defined.
    rules: [

        //Take a combination of 12 letters and numbers, both lower and upper case.
        {
            characters: 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890',
            max: 8
        },

    ],
    generate: function () {
        var g = '';

        $.each(password.rules, function (k, v) {
            var m = v.max;
            for (var i = 1; i <= m; i++) {
                g = g + v.characters[Math.floor(Math.random() * (v.characters.length))];
            }
            if (v.callback) {
                g = v.callback(g);
            }
        });
        return g;
    }
}
