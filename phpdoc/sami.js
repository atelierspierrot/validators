(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '    <ul>                <li data-name="namespace:Validator" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Validator.html">Validator</a>                    </div>                    <div class="bd">                            <ul>                <li data-name="class:Validator_AbstractMasksValidatorHelper" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Validator/AbstractMasksValidatorHelper.html">AbstractMasksValidatorHelper</a>                    </div>                </li>                            <li data-name="class:Validator_EmailValidator" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Validator/EmailValidator.html">EmailValidator</a>                    </div>                </li>                            <li data-name="class:Validator_HostnameValidator" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Validator/HostnameValidator.html">HostnameValidator</a>                    </div>                </li>                            <li data-name="class:Validator_InternetProtocolValidator" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Validator/InternetProtocolValidator.html">InternetProtocolValidator</a>                    </div>                </li>                            <li data-name="class:Validator_StringLengthValidator" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Validator/StringLengthValidator.html">StringLengthValidator</a>                    </div>                </li>                            <li data-name="class:Validator_StringMaskValidator" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Validator/StringMaskValidator.html">StringMaskValidator</a>                    </div>                </li>                            <li data-name="class:Validator_ValidatorInterface" class="opened">                    <div style="padding-left:26px" class="hd leaf">                        <a href="Validator/ValidatorInterface.html">ValidatorInterface</a>                    </div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    {"type": "Namespace", "link": "Validator.html", "name": "Validator", "doc": "Namespace Validator"},
            {"type": "Interface", "fromName": "Validator", "fromLink": "Validator.html", "link": "Validator/ValidatorInterface.html", "name": "Validator\\ValidatorInterface", "doc": "&quot;Validator interface&quot;"},
                                                        {"type": "Method", "fromName": "Validator\\ValidatorInterface", "fromLink": "Validator/ValidatorInterface.html", "link": "Validator/ValidatorInterface.html#method_validate", "name": "Validator\\ValidatorInterface::validate", "doc": "&quot;Process validation, must return a boolean&quot;"},
                    {"type": "Method", "fromName": "Validator\\ValidatorInterface", "fromLink": "Validator/ValidatorInterface.html", "link": "Validator/ValidatorInterface.html#method_sanitize", "name": "Validator\\ValidatorInterface::sanitize", "doc": "&quot;Try to make &lt;code&gt;$value&lt;\/code&gt; pass the validation&quot;"},
            
            
            {"type": "Class", "fromName": "Validator", "fromLink": "Validator.html", "link": "Validator/AbstractMasksValidatorHelper.html", "name": "Validator\\AbstractMasksValidatorHelper", "doc": "&quot;The application validator model&quot;"},
                                                        {"type": "Method", "fromName": "Validator\\AbstractMasksValidatorHelper", "fromLink": "Validator/AbstractMasksValidatorHelper.html", "link": "Validator/AbstractMasksValidatorHelper.html#method_setMasks", "name": "Validator\\AbstractMasksValidatorHelper::setMasks", "doc": "&quot;Register a new mask set&quot;"},
                    {"type": "Method", "fromName": "Validator\\AbstractMasksValidatorHelper", "fromLink": "Validator/AbstractMasksValidatorHelper.html", "link": "Validator/AbstractMasksValidatorHelper.html#method_addMask", "name": "Validator\\AbstractMasksValidatorHelper::addMask", "doc": "&quot;Register a new mask&quot;"},
                    {"type": "Method", "fromName": "Validator\\AbstractMasksValidatorHelper", "fromLink": "Validator/AbstractMasksValidatorHelper.html", "link": "Validator/AbstractMasksValidatorHelper.html#method_getMasks", "name": "Validator\\AbstractMasksValidatorHelper::getMasks", "doc": "&quot;Get the masks registry&quot;"},
                    {"type": "Method", "fromName": "Validator\\AbstractMasksValidatorHelper", "fromLink": "Validator/AbstractMasksValidatorHelper.html", "link": "Validator/AbstractMasksValidatorHelper.html#method_getMask", "name": "Validator\\AbstractMasksValidatorHelper::getMask", "doc": "&quot;Get a registered mask&quot;"},
            
            {"type": "Class", "fromName": "Validator", "fromLink": "Validator.html", "link": "Validator/EmailValidator.html", "name": "Validator\\EmailValidator", "doc": "&quot;Email validator&quot;"},
                                                        {"type": "Method", "fromName": "Validator\\EmailValidator", "fromLink": "Validator/EmailValidator.html", "link": "Validator/EmailValidator.html#method___construct", "name": "Validator\\EmailValidator::__construct", "doc": "&quot;Constructor : register useful masks&quot;"},
                    {"type": "Method", "fromName": "Validator\\EmailValidator", "fromLink": "Validator/EmailValidator.html", "link": "Validator/EmailValidator.html#method_validate", "name": "Validator\\EmailValidator::validate", "doc": "&quot;Process validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\EmailValidator", "fromLink": "Validator/EmailValidator.html", "link": "Validator/EmailValidator.html#method_sanitize", "name": "Validator\\EmailValidator::sanitize", "doc": "&quot;Try to make $value pass the validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\EmailValidator", "fromLink": "Validator/EmailValidator.html", "link": "Validator/EmailValidator.html#method_validateLocalPart", "name": "Validator\\EmailValidator::validateLocalPart", "doc": "&quot;Process local part validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\EmailValidator", "fromLink": "Validator/EmailValidator.html", "link": "Validator/EmailValidator.html#method_validateDomainPart", "name": "Validator\\EmailValidator::validateDomainPart", "doc": "&quot;Process domain part validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\EmailValidator", "fromLink": "Validator/EmailValidator.html", "link": "Validator/EmailValidator.html#method_setMustPass", "name": "Validator\\EmailValidator::setMustPass", "doc": "&quot;Defines the RFC to validate&quot;"},
            
            {"type": "Class", "fromName": "Validator", "fromLink": "Validator.html", "link": "Validator/HostnameValidator.html", "name": "Validator\\HostnameValidator", "doc": "&quot;Email address validator&quot;"},
                                                        {"type": "Method", "fromName": "Validator\\HostnameValidator", "fromLink": "Validator/HostnameValidator.html", "link": "Validator/HostnameValidator.html#method___construct", "name": "Validator\\HostnameValidator::__construct", "doc": "&quot;Constructor : register useful masks&quot;"},
                    {"type": "Method", "fromName": "Validator\\HostnameValidator", "fromLink": "Validator/HostnameValidator.html", "link": "Validator/HostnameValidator.html#method_validate", "name": "Validator\\HostnameValidator::validate", "doc": "&quot;Process validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\HostnameValidator", "fromLink": "Validator/HostnameValidator.html", "link": "Validator/HostnameValidator.html#method_sanitize", "name": "Validator\\HostnameValidator::sanitize", "doc": "&quot;Try to make $value pass the validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\HostnameValidator", "fromLink": "Validator/HostnameValidator.html", "link": "Validator/HostnameValidator.html#method_setMustPass", "name": "Validator\\HostnameValidator::setMustPass", "doc": "&quot;Defines the RFC to validate&quot;"},
            
            {"type": "Class", "fromName": "Validator", "fromLink": "Validator.html", "link": "Validator/InternetProtocolValidator.html", "name": "Validator\\InternetProtocolValidator", "doc": "&quot;IP address validator&quot;"},
                                                        {"type": "Method", "fromName": "Validator\\InternetProtocolValidator", "fromLink": "Validator/InternetProtocolValidator.html", "link": "Validator/InternetProtocolValidator.html#method___construct", "name": "Validator\\InternetProtocolValidator::__construct", "doc": "&quot;Constructor&quot;"},
                    {"type": "Method", "fromName": "Validator\\InternetProtocolValidator", "fromLink": "Validator/InternetProtocolValidator.html", "link": "Validator/InternetProtocolValidator.html#method_setVersion", "name": "Validator\\InternetProtocolValidator::setVersion", "doc": "&quot;Set the version of the protocol to use&quot;"},
                    {"type": "Method", "fromName": "Validator\\InternetProtocolValidator", "fromLink": "Validator/InternetProtocolValidator.html", "link": "Validator/InternetProtocolValidator.html#method_validate", "name": "Validator\\InternetProtocolValidator::validate", "doc": "&quot;Process validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\InternetProtocolValidator", "fromLink": "Validator/InternetProtocolValidator.html", "link": "Validator/InternetProtocolValidator.html#method_sanitize", "name": "Validator\\InternetProtocolValidator::sanitize", "doc": "&quot;Try to make $value pass the validation&quot;"},
            
            {"type": "Class", "fromName": "Validator", "fromLink": "Validator.html", "link": "Validator/StringLengthValidator.html", "name": "Validator\\StringLengthValidator", "doc": "&quot;String length validator&quot;"},
                                                        {"type": "Method", "fromName": "Validator\\StringLengthValidator", "fromLink": "Validator/StringLengthValidator.html", "link": "Validator/StringLengthValidator.html#method___construct", "name": "Validator\\StringLengthValidator::__construct", "doc": "&quot;Constructor : register useful masks&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringLengthValidator", "fromLink": "Validator/StringLengthValidator.html", "link": "Validator/StringLengthValidator.html#method_setMinLength", "name": "Validator\\StringLengthValidator::setMinLength", "doc": "&quot;Set the minimum string length\nMinimum length - 1 will not pass the validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringLengthValidator", "fromLink": "Validator/StringLengthValidator.html", "link": "Validator/StringLengthValidator.html#method_setMaxLength", "name": "Validator\\StringLengthValidator::setMaxLength", "doc": "&quot;Set the maximum string length\nMaximum length + 1 will not pass the validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringLengthValidator", "fromLink": "Validator/StringLengthValidator.html", "link": "Validator/StringLengthValidator.html#method_validate", "name": "Validator\\StringLengthValidator::validate", "doc": "&quot;Process validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringLengthValidator", "fromLink": "Validator/StringLengthValidator.html", "link": "Validator/StringLengthValidator.html#method_sanitize", "name": "Validator\\StringLengthValidator::sanitize", "doc": "&quot;Try to make $value pass the validation&quot;"},
            
            {"type": "Class", "fromName": "Validator", "fromLink": "Validator.html", "link": "Validator/StringMaskValidator.html", "name": "Validator\\StringMaskValidator", "doc": "&quot;String mask validator&quot;"},
                                                        {"type": "Method", "fromName": "Validator\\StringMaskValidator", "fromLink": "Validator/StringMaskValidator.html", "link": "Validator/StringMaskValidator.html#method___construct", "name": "Validator\\StringMaskValidator::__construct", "doc": "&quot;Constructor&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringMaskValidator", "fromLink": "Validator/StringMaskValidator.html", "link": "Validator/StringMaskValidator.html#method_setMask", "name": "Validator\\StringMaskValidator::setMask", "doc": "&quot;Set the mask to test for values\nThe mask can be escaped by the &#039;preg_quote&#039; function setting the second argument on TRUE.&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringMaskValidator", "fromLink": "Validator/StringMaskValidator.html", "link": "Validator/StringMaskValidator.html#method_setMaskReference", "name": "Validator\\StringMaskValidator::setMaskReference", "doc": "&quot;Set the mask reference&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringMaskValidator", "fromLink": "Validator/StringMaskValidator.html", "link": "Validator/StringMaskValidator.html#method_setPcreOptions", "name": "Validator\\StringMaskValidator::setPcreOptions", "doc": "&quot;Set the PCRE options&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringMaskValidator", "fromLink": "Validator/StringMaskValidator.html", "link": "Validator/StringMaskValidator.html#method_setPcreDelimiter", "name": "Validator\\StringMaskValidator::setPcreDelimiter", "doc": "&quot;Set the PCRE delimiter&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringMaskValidator", "fromLink": "Validator/StringMaskValidator.html", "link": "Validator/StringMaskValidator.html#method_setPregQuote", "name": "Validator\\StringMaskValidator::setPregQuote", "doc": "&quot;Set the protection on mask&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringMaskValidator", "fromLink": "Validator/StringMaskValidator.html", "link": "Validator/StringMaskValidator.html#method_validate", "name": "Validator\\StringMaskValidator::validate", "doc": "&quot;Process validation&quot;"},
                    {"type": "Method", "fromName": "Validator\\StringMaskValidator", "fromLink": "Validator/StringMaskValidator.html", "link": "Validator/StringMaskValidator.html#method_sanitize", "name": "Validator\\StringMaskValidator::sanitize", "doc": "&quot;Try to make $value pass the validation&quot;"},
            
            {"type": "Class", "fromName": "Validator", "fromLink": "Validator.html", "link": "Validator/ValidatorInterface.html", "name": "Validator\\ValidatorInterface", "doc": "&quot;Validator interface&quot;"},
                                                        {"type": "Method", "fromName": "Validator\\ValidatorInterface", "fromLink": "Validator/ValidatorInterface.html", "link": "Validator/ValidatorInterface.html#method_validate", "name": "Validator\\ValidatorInterface::validate", "doc": "&quot;Process validation, must return a boolean&quot;"},
                    {"type": "Method", "fromName": "Validator\\ValidatorInterface", "fromLink": "Validator/ValidatorInterface.html", "link": "Validator/ValidatorInterface.html#method_sanitize", "name": "Validator\\ValidatorInterface::sanitize", "doc": "&quot;Try to make &lt;code&gt;$value&lt;\/code&gt; pass the validation&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


