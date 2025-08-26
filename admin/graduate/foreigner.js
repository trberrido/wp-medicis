(function() {
    const { registerPlugin } = wp.plugins;
    const { PluginDocumentSettingPanel } = wp.editPost;
    const { TextControl } = wp.components;
    const { useSelect, useDispatch } = wp.data;
    const { createElement } = wp.element;

    // Component for the graduated book fields
    const GraduateFieldsPanel = () => {
        // Get current post data
        const { meta, postType } = useSelect((select) => ({
            meta: select('core/editor').getEditedPostAttribute('meta') || {},
            postType: select('core/editor').getCurrentPostType()
        }));

        // Get dispatch functions
        const { editPost } = useDispatch('core/editor');

        if (postType !== 'graduate') {
            return null;
        }

        // Get current values
        const translatorValue = meta.pm__graduate__translator_name || '';
        const countryValue = meta.pm__graduate__country || '';

        // Handle translator change
        const onTranslatorChange = (value) => {
            editPost({
                meta: {
                    ...meta,
                    pm__graduate__translator_name: value
                }
            });
        };

        // Handle country change
        const onCountryChange = (value) => {
            editPost({
                meta: {
                    ...meta,
                    pm__graduate__country: value
                }
            });
        };

        return createElement('div', null, [
            createElement(TextControl, {
                key: 'translator',
                label: 'Traducteur',
                value: translatorValue,
                onChange: onTranslatorChange
            }),
            createElement(TextControl, {
                key: 'country',
                label: 'Pays',
                value: countryValue,
                onChange: onCountryChange
            })
        ]);
    };

    // Main plugin component
    const GraduateFieldsPlugin = () => {

        const postType = useSelect((select) => {
            const { getCurrentPostType, getEditedPostAttribute } = select('core/editor');
            const { getEntityRecords } = select('core');
            return getCurrentPostType();
        });

        if (postType !== 'graduate') {
            return null;
        }

        return createElement(PluginDocumentSettingPanel, {
            name: 'graduate-foreigner-fields-panel',
            title: 'Prix étranger',
            className: 'graduate-foreigner-fields-panel'
        }, createElement(GraduateFieldsPanel));
    };

    // Register the plugin
    registerPlugin('graduate-foreigner-fields', {
        render: GraduateFieldsPlugin,
        icon: null
    });
})();