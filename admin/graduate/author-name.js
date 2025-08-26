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
        const authorNameValue = meta.pm__graduate__author_name || '';

        // Handle translator change
        const onAuthorNameChange = (value) => {
            editPost({
                meta: {
                    ...meta,
                    pm__graduate__author_name: value
                }
            });
        };

        return createElement('div', null, [
            createElement(TextControl, {
                key: 'author',
                label: 'Nom',
                value: authorNameValue,
                onChange: onAuthorNameChange
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
            name: 'graduate-fields-panel',
            title: 'Auteur',
            className: 'graduate-fields-panel'
        }, createElement(GraduateFieldsPanel));
    };

    // Register the plugin
    registerPlugin('graduate-fields', {
        render: GraduateFieldsPlugin,
        icon: null
    });
})();