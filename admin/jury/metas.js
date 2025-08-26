(function() {
    const { registerPlugin } = wp.plugins;
    const { PluginDocumentSettingPanel } = wp.editPost;
    const { TextControl } = wp.components;
    const { useSelect, useDispatch } = wp.data;
    const { createElement } = wp.element;

    // Component for the juryd book fields
    const JuryFieldsPanel = () => {
        // Get current post data
        const { meta, postType } = useSelect((select) => ({
            meta: select('core/editor').getEditedPostAttribute('meta') || {},
            postType: select('core/editor').getCurrentPostType()
        }));

        // Get dispatch functions
        const { editPost } = useDispatch('core/editor');

        if (postType !== 'jury') {
            return null;
        }

        // Get current values
        const secondTitleValue = meta.pm__jury__second_title || '';
        const datesValue = meta.pm__jury__dates || '';

        // Handle secondTitle change
        const onSecondTitleChange = (value) => {
            editPost({
                meta: {
                    ...meta,
                    pm__jury__second_title: value
                }
            });
        };

        // Handle dates change
        const onDatesChange = (value) => {
            editPost({
                meta: {
                    ...meta,
                    pm__jury__dates: value
                }
            });
        };

        return createElement('div', null, [
            createElement(TextControl, {
                key: 'secondTitle',
                label: 'Sous titre',
                value: secondTitleValue,
                onChange: onSecondTitleChange
            }),
            createElement(TextControl, {
                key: 'dates',
                label: 'Dates',
                value: datesValue,
                onChange: onDatesChange
            })
        ]);
    };

    // Main plugin component
    const JuryFieldsPlugin = () => {

        const postType = useSelect((select) => {
            const { getCurrentPostType, getEditedPostAttribute } = select('core/editor');
            return getCurrentPostType();
        });

        if (postType !== 'jury') {
            return null;
        }

        return createElement(PluginDocumentSettingPanel, {
            name: 'jury-fields-panel',
            title: 'Infos',
            className: 'jury-fields-panel'
        }, createElement(JuryFieldsPanel));
    };

    // Register the plugin
    registerPlugin('jury-fields', {
        render: JuryFieldsPlugin,
        icon: null
    });
})();