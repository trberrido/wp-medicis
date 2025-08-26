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

        const { postType, categoryObjects } = useSelect((select) => {
            const { getCurrentPostType, getEditedPostAttribute } = select('core/editor');
            const { getEntityRecords } = select('core');
            const categoryIds = getEditedPostAttribute('graduate_prize') || [];
            const categories = categoryIds.length > 0 
                ? getEntityRecords('taxonomy', 'graduate_prize', { include: categoryIds }) || []
                : [];
            
            return {
                postType: getCurrentPostType(),
                categoryObjects: categories
            };
        });

        if (postType !== 'graduate') {
            return null;
        }

    /*
        Show only if "Étranger" prize is selected. Featured removed.
        const targetPrize = 'Étranger';
        const hasTargetPrize = categoryObjects.some(cat => cat && cat.name === targetPrize);
        if (!hasTargetPrize) {
            return null;
        }
    */

        return createElement(PluginDocumentSettingPanel, {
            name: 'graduate-fields-panel',
            title: 'Prix étranger',
            className: 'graduate-fields-panel'
        }, createElement(GraduateFieldsPanel));
    };

    // Register the plugin
    registerPlugin('graduate-fields', {
        render: GraduateFieldsPlugin,
        icon: null
    });
})();