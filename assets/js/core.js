var page = {
    homepage: 'page1',
    history: [],

    /**
    * This method change the current page to the one indcated
    * @param {String} pageId, id of the page to load
    * @param {Object} callback, before: for before the page be displayed
    *                           after: for after the page be displayed
                                vars: for variable to pass to next page
    */
    to: function(pageId, callback) {
        var nextpage = _('#'+pageId);

        if (_('.page.active')) {
            if (!_('.page.active').classList.contains('jump') && (!callback || !callback.jump)){
                this.history.push(_('.page.active').id);
                window.history.pushState(null, 'app', "#"+pageId);
            }

            _('.page.active').classList.remove('active');
        }

        var loading = new Promise(function (resolve, failed) {
            if (callback && callback.before) {
                callback.before(nextpage, resolve, callback.vars, failed);
            }
            else {
                resolve();
            }
        });

        loading.then(function() {
            _('#'+pageId).classList.add('active');
            window.scrollTo(0,0);
            if (callback && callback.after) {
                callback.after(nextpage, callback.vars);
            }
        });
    },

    previous: function() {
        var previousPage = this.history[this.history.length-1] || null;

        if (previousPage) {
            this.jumpTo(previousPage);
            this.history.pop();
        }
    },

    jumpTo: function (page) {
        this.to(page, {jump:true});
    },

    init: function(pageId, callback) {
        this.to(pageId, callback);
    },

    templatize: {
        simple: function (vars, text) {
            return (text).replace(/\{\{(\w+)\}\}/ig, function(m, term) {
                return vars[term];
            });
        },
        tmpl: function (vars, text) {
            return tmpl(text, vars);
        },
        mustache: function (vars, text) {
            return Mustache.render(text, {o: vars});
        },
        ejs: function (vars, text) {
            return ejs.render(text, {o: vars});
        }
    },

    getTemplate: function (path) {
        return $.ajax({
            type: 'get',
            url: path,
            dataType: 'text'
        });
    },

    toggleMenu: function (param) {
        var iInner = $('.appbar .left-icon').find('i');
        if (param=='hide') {
            $('.left-menu').removeClass('active');
            iInner.html('menu');
        }
        else {
            $('.left-menu').toggleClass('active');
            iInner.html( (iInner.html()=='menu' ? 'clear' : 'menu') );
        }
    },

    toggleLoader: function (content, param) {
        var inner = $('.loader.load .text-part');
        content = content || "Chargement en cours ...";

        inner.html(inner.html().length ? inner.html() : content);

        if (content == 'hide') {
            $('.loader.load').removeClass('opened');
            page.timeout(function () { $('.loader.load').css({ "display": "none" }) }, 300);
            return;
        }

        if ($('.loader.load').hasClass('opened')) {
            $('.loader.load').removeClass('opened');
            page.timeout(function () { $('.loader.load').css({ "display": "none" }) }, 300);
        }
        else {
            $('.loader.load').css({ "display": "block" });
            page.timeout(function () { $('.loader.load').addClass('opened'); }, 50);
        }
    },

    toggleValidAlert: function (content, type, timeout) {
        content = content || "Chargement ...."; timeout = timeout || 3000;

        var icons = {"success": "done", "error": "highlight_off", "info": "info_ouline"}
        var inner = $('.loader.validalert .text-part');

        var hidealert = function () {
            $('.loader.validalert .icon').removeClass('shown');
            page.timeout(function(){
                $('.loader.validalert').removeClass('opened');
                page.timeout(function () { $('.loader.validalert').css({ "display": "none" }) }, 300);
            }, 200);
        },  showalert = function () {
            $('.loader.validalert').css({ "display": "block" });
            page.timeout(function () { $('.loader.validalert').addClass('opened'); }, 50);
            page.timeout(function () { $('.loader.validalert .icon').addClass('shown'); }, 300);
        }

        inner.html(inner.text().trim().length && content=="Chargement ...." ? inner.text() : content);
        $('.loader.validalert .spinner-part .icon i').text(icons[type]);

        if (content == 'hide') {
            hidealert();
            return;
        }

        if ($('.loader.validalert').hasClass('opened')) {
            hidealert();
        }
        else {
            showalert();
            if (timeout) {
                page.timeout(function () { hidealert('hide') }, timeout);
            }
        }
    },

    timeout: function (handle, time) {
        return setTimeout(function () {
            handle();
        }, time);
    }
}

var _ajax = {
    object: new XMLHttpRequest(),

    timeout: 3000,

    post: function (options) {
        this.query('post', options.datas, options.url, options.header, options.callback, options.fail, options.timeout);
    },

    get: function (options) {
        this.query('get', null, options.url, options.header, options.callback, options.fail, options.timeout);
    },

    query: function (type, datas, url, header, callback, fail, timeout) {
        this.object.open(type, url);

        if (type.toLowerCase() == 'post') {
            if (header) {
                this.object.setRequestHeader(header.split(':')[0], header.split(':')[1]);
            }
            else {
                this.object.setRequestHeader('Content-Type', 'text/plain');
            }

            var stringvalues = [];

            for(var a in datas) {
                stringvalues.push(a+'='+datas[a]);
            }

            datas = stringvalues.join('&');
        }

        this.object.onload = function () {
            if (this.status == 200) {
                if (callback) callback(this.responseText);
            }
            else {
                if (fail) fail("Une erreur s'est produite. CODE: "+this.status, this.status);
            }
        };

        this.object.onerror = function () {
            if (fail) fail("Une erreur s'est produite. CODE: "+this.status, this.status);
        };

        this.object.ontimeout = function () {
            if (fail) fail("Une erreur s'est produite. CODE: TIMEOUT ERROR");
        };

        this.object.timeout = timeout ? timeout : this.timeout;

        // console.log(datas);
        this.object.send(datas);
    }
};

function _(selector) {
    if (document.querySelectorAll(selector)) {
        var sel = document.querySelectorAll(selector);
        /* return what founded */
        return sel.length > 1 ? sel : sel[0];
    }
    else {
        console.log("Selected element not found");
        return false;
    }
}

// [].forEach.call(_('.right-icon.small-menu'), function(icon) {
//     icon.addEventListener('click', function(e) {
//         if (this.querySelector('ul').getAttribute('data-toggle')=='0') {
//             this.querySelector('ul').classList.add('opened');
//             this.querySelector('ul').setAttribute('data-toggle', '1');
//         }
//         else {
//             this.querySelector('ul').classList.remove('opened');
//             this.querySelector('ul').setAttribute('data-toggle', '0');
//         }
//     });
// });

document.addEventListener('click', function (e) {
    if (!e.target.classList.contains('dropmenu') && e.target.classList.contains('mdi') && e.target.classList.contains('right-icon')) {
        [].forEach.call(_('ul.dropmenu'), function(element) {
            element.classList.remove('opened');
        });
    }
});

window.addEventListener('popstate', function (state) {
    var pageId = window.location.hash.substring(1);
    if (pageId.trim().length && document.querySelector('#'+pageId).classList.contains('page') && document.querySelector('#'+pageId)){
        page.jumpTo(pageId);
    }
    else {
        page.jumpTo(page.homepage);
    }
});