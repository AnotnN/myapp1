/**
 * i18n add-on
 * This add-on allow to define message in multiple languages
 *
 * @link        http://formvalidation.io/addons/i18n/
 * @license     http://formvalidation.io/license/
 * @author      https://twitter.com/formvalidation
 * @copyright   (c) 2013 - 2015 Nguyen Huu Phuoc
 */
(function($) {
    /**
     * The 'message' option of each validator can be
     * - a literal object mapping the locale with message
     *  $(form).formValidation({
     *      fields: {
     *          fieldName: {
     *              validators: {
     *                  validatorName: {
     *                      message: {
     *                          en_US: 'The message in English',
     *                          fr_FR: 'The message in French'
     *                      }
     *                  }
     *              }
     *          }
     *      }
     *  });
     *  - or a callback function returns the literal object as above
     *  $(form).formValidation({
     *      fields: {
     *          fieldName: {
     *              validators: {
     *                  validatorName: {
     *                      message: function(validator, $field, validatorName) {
     *                          return {
     *                              en_US: 'The message in English',
     *                              fr_FR: 'The message in French'
     *                          };
     *                      }
     *                  }
     *              }
     *          }
     *      }
     *  });
     *  - or taken from language package
     *  $(form).formValidation({
     *      fields: {
     *          fieldName: {
     *              validators: {
     *                  validatorName: {
     *                  }
     *              }
     *          }
     *      }
     *  });
     */
    FormValidation.AddOn.i18n = {
        /**
         * @param {FormValidation.Base} validator The validator instance
         * @param {Object} options The add-on options
         */
        init: function(validator, options) {
            var that  = this,
                $form = validator.getForm(),
                opts  = validator.getOptions();

            // Clone the original options
            $form.data('fv.addon.i18n.options', $.extend(true, {}, opts));
            this._setMessage(validator);

            // Update the message when changing the locale
            $form.on(opts.events.localeChanged, function(e, data) {
                that._setMessage(data.fv);
            });
        },

        destroy: function(validator, options) {
            validator.getForm().removeData('fv.addon.i18n.options');
        },

        _setMessage: function(validator) {
            var $form   = validator.getForm(),
                options = $form.data('fv.addon.i18n.options'),
                locale  = validator.getLocale();

            for (var field in options.fields) {
                if (!options.fields[field].validators) {
                    continue;
                }

                var fields = validator.getFieldElements(field),
                    type   = fields.attr('type'),
                    total  = ('radio' === type || 'checkbox' === type) ? 1 : fields.length;

                for (var i = 0; i < total; i++) {
                    var $field = fields.eq(i);

                    for (var v in options.fields[field].validators) {
                        var message     = options.fields[field].validators[v].message,
                            messageType = typeof message,
                            localized   = null;

                        // message is a literal object
                        if ('object' === messageType && message[locale]) {
                            localized = message[locale];
                        }
                        // message is defined by a function
                        else if ('function' === messageType) {
                            var result = message.apply(this, [validator, $field, v]);
                            if (result && result[locale]) {
                                localized = result[locale];
                            }
                        }

                        // message is defined by language package
                        if (localized === null && FormValidation.I18n[locale][v]['default']) {
                            localized = FormValidation.I18n[locale][v]['default'];
                        }

                        if (localized) {
                            validator.updateMessage(field, v, localized)
                                     .updateOption(field, v, 'message', localized);
                        }
                    }
                }
            }
        }
    };
}(jQuery));
