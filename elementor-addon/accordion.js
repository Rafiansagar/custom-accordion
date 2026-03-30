(function ($) {
    $(window).on('elementor/frontend/init', function () {

        const moduleHandler = elementorModules.frontend.handlers.Base;

        const accordion = moduleHandler.extend({

            bindEvents() {
                const element = this.$element.find('.rs-accordion');
                if (!element.length) return;

                const settings = this.getElementSettings();
                const mode = settings.expand_mode || 'exclusive';

                let allOpen = false;

                const accordion = element[0];

                const toggleAllBtn = element.find('.open-all-btn');
                toggleAllBtn.click(function () { 
                    toggleAll();
                });

                const allItems = () => accordion.querySelectorAll('.aea-item');

                function openItem(item) {
                    item.classList.add('open');
                    item.querySelector('.aea-trigger').setAttribute('aria-expanded', 'true');
                }

                function closeItem(item) {
                    item.classList.remove('open');
                    item.querySelector('.aea-trigger').setAttribute('aria-expanded', 'false');
                }

                allItems().forEach(item => {
                    item.querySelector('.aea-trigger').addEventListener('click', () => {
                        const isOpen = item.classList.contains('open');

                        if (mode === 'exclusive') {
                            allItems().forEach(closeItem);
                            if (!isOpen) openItem(item);
                        } else {
                            isOpen ? closeItem(item) : openItem(item);
                        }

                        syncExpandAllBtn();
                    });
                });

                function toggleAll() {
                    allOpen = !allOpen;
                    allItems().forEach(item => allOpen ? openItem(item) : closeItem(item));
                    syncExpandAllBtn();
                }

                function syncExpandAllBtn() {
                    const openCount = accordion.querySelectorAll('.aea-item.open').length;
                    const total = allItems().length;
                    allOpen = openCount === total;
                    if ( allOpen ) {
                        toggleAllBtn.addClass('btn-open');
                    } else {
                        toggleAllBtn.removeClass('btn-open');
                    }
                }
            }
        });

        elementorFrontend.hooks.addAction(
            'frontend/element_ready/rs-accordion.default',
            function ($scope) {
                elementorFrontend.elementsHandler.addHandler(accordion, {
                    $element: $scope
                });
            }
        );
    });
})(jQuery);