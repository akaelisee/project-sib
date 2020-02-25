var url = 'locale';

var app = {
    baseUri: null,

    notyf: new Notyf({delay: 3000}),

    initialize: function() {
        app.baseUri = url === 'locale' ? 'http://192.168.1.160/sib/admin/?/' : 'http://sib.constantmissa.ci/';

        page.init("page1", {
            after: function() {
                setTimeout(function() {
                    page.to("page2");
                }, 2000);
                /**/
                app.loadAgencies();
                app.loadInfos();
            },
            jump: true
        });
    },

    setUrl: function(url) {
        return app.baseUri + url;
    },

    showMeetForm: function(page, client) {
        if (client === 'client') {
            $('.no-client').hide();
            $('.client').show();
            $('#meetform #formtype').val(1);
            app.findAgency($('#agencycode').val());
        }
        else {
            $('.no-client').show();
            $('.client').hide();
            $('#meetform #formtype').val(0);
        }
    },

    toggleInfos: function(el) {
        if (!$(el).parent().hasClass('active')) {
            $('.applist li.active').removeClass('active');
            $(el).parent().addClass('active');
        }
        else {
            $(el).parent().removeClass('active');
        }
    },

    loadAgencies: function() {
        app.loadDatas('agency', $('#page7 .applist'));
    },

    loadInfos: function() {
        app.loadDatas('infos', $('#page6 .applist'));
    },

    loadDatas: function(type, $fill) {
        $.ajax({
            type: 'get',
            url: app.setUrl(type) + '-list',
            dataType: 'json'
        }).done(function (datas) {
            page.getTemplate('templates/' + type + '.tpl.html').then(function (content) {
                $fill.html(page.templatize.ejs(datas, content));
            });
        });
    },

    sendMeet: function() {
        app.loader().show();
        app.submitForm($('#meetform'), app.setUrl('meeting'), function (response) {
            app.loader().hide();
            app.notyf[response.error ? 'alert' : 'confirm'](response.message);
            if (!response.error) $('#meetform')[0].reset();
         },
        function (err) {
            app.loader().hide();
            app.notyf.alert("Une erreur est survenue ! Vérifiez votre connexion et réessayez SVP.");
        });
    },

    sendMessage: function() {
        app.loader().show();
        app.submitForm($('#contactform'), app.setUrl('message'), function (response) {
            app.loader().hide();
            app.notyf[response.error ? 'alert' : 'confirm'](response.message);
            if (!response.error) $('#contactform')[0].reset();
        },
        function (err) {
            app.loader().hide();
            app.notyf.alert("Une erreur est survenue ! Vérifiez votre connexion et réessayez SVP.");
        });
    },

    findAgency: function(value) {
      $.get({
          url: app.setUrl('agency-check/agency=' + value),
          dataType: 'json'
      })
      .done(function (response) {
          $('#meetform .agencecheck span').text(response ? response.nom : 'Inconnue !').attr({class: response ? 'yellow-text' : ''});
          $('#meetform #agencycode').val(response ? response.identifiant : '');
      });
    },

    submitForm: function($form, $action, handle, error) {
        console.log($action);
        $.post({
            url: $action,
            data: $form.serialize(),
            dataType: 'json'
        })
        .done(function (response) {
            handle(response);
        })
        .fail(function (err) {
            error(err);
        });
    },

    loader: function(options) {
        options = options ? options : {};
        return {
            init: function() {
                $('#loader .loader-message').text(options.message ? options.message : 'Chargement ...');
                return this;
            },
            show: function() {
                this.init();
                $('#loader').fadeIn();
                return this;
            },
            hide: function() {
                setTimeout(function () {
                    $('#loader').fadeOut();
                }, 1000);
                return this;
            },
            proceed: function() {
                this.init().show();
                /**/
                var loading = new Promise(function (resolve, failed) {
                    options.process();
                });

                loading.then(function () {
                    console.log('Humm end !');
                });
            }
        }
    }
};