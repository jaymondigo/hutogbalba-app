(function() {

    var DreamBuilder = {

        NAME: '',

        ID: 0,

        THREED: null,

        TWOD: null,

        setLength: function(l) {

            this._length = l;

            return this;

        },

        setHeight: function(h) {

            this._height = h;

            return this;

        },

        setWidth: function(w) {

            this._width = w;

            return this;

        },

        get: function(p) {

            return this['_' + p];

        },

        divider: 0,

        house: {

            rooms: [],

            windows: [],

            doors: [],

            walls: []

        },

        currentSet: null

    };

    window.DreamBuilder = DreamBuilder;

})();