(function() {
    const { registerPlugin } = wp.plugins;
    const { PluginDocumentSettingPanel } = wp.editPost;
    const { TextControl, Button, Icon } = wp.components;
    const { useSelect, useDispatch } = wp.data;
    const { createElement, useState, useEffect } = wp.element;

    // Component for the links field
    const GraduateLinksPanel = () => {
        // Get current post data
        const { meta, postType } = useSelect((select) => ({
            meta: select('core/editor').getEditedPostAttribute('meta') || {},
            postType: select('core/editor').getCurrentPostType()
        }));

        // Get dispatch functions
        const { editPost } = useDispatch('core/editor');

        // Only show for 'graduate' post type
        if (postType !== 'graduate') {
            return null;
        }

        // Parse current links from JSON
        const parseLinks = (jsonString) => {
            if (!jsonString) return [{ title: '', url: '' }];
            try {
                const parsed = JSON.parse(jsonString);
                return parsed.length > 0 ? parsed : [{ title: '', url: '' }];
            } catch (e) {
                return [{ title: '', url: '' }];
            }
        };

        // Local state for links
        const [links, setLinks] = useState(() => parseLinks(meta.pm__graduate__links));

        // Update local state when meta changes
        useEffect(() => {
            setLinks(parseLinks(meta.pm__graduate__links));
        }, [meta.pm__graduate__links]);

        // Save links to meta
        const saveLinks = (newLinks) => {
            // Filter out empty links
            const validLinks = newLinks.filter(link => link.title.trim() || link.url.trim());
            
            editPost({
                meta: {
                    ...meta,
                    pm__graduate__links: JSON.stringify(validLinks)
                }
            });
        };

        // Update a specific link
        const updateLink = (index, field, value) => {
            const newLinks = [...links];
            newLinks[index] = { ...newLinks[index], [field]: value };
            setLinks(newLinks);
            saveLinks(newLinks);
        };

        // Add new link
        const addLink = () => {
            const newLinks = [...links, { title: '', url: '' }];
            setLinks(newLinks);
            saveLinks(newLinks);
        };

        // Remove a link
        const removeLink = (index) => {
            if (links.length <= 1) return; // Keep at least one
            const newLinks = links.filter((_, i) => i !== index);
            setLinks(newLinks);
            saveLinks(newLinks);
        };

        return createElement('div', { style: { marginBottom: '16px' } }, [
            // Links list
            ...links.map((link, index) => 
                createElement('div', {
                    key: index,
                    style: {
                        border: '1px solid #ddd',
                        padding: '12px',
                        marginBottom: '8px',
                        borderRadius: '4px',
                        backgroundColor: '#f9f9f9'
                    }
                }, [
                    createElement(TextControl, {
                        key: 'title',
                        label: `Lien ${index + 1} - Titre`,
                        value: link.title,
                        onChange: (value) => updateLink(index, 'title', value),
                        placeholder: 'Titre du lien'
                    }),
                    createElement(TextControl, {
                        key: 'url',
                        label: 'URL',
                        value: link.url,
                        onChange: (value) => updateLink(index, 'url', value),
                        placeholder: 'https://example.com'
                    }),
                    links.length > 1 && createElement(Button, {
                        key: 'remove',
                        isDestructive: true,
                        variant: 'secondary',
                        isSmall: true,
                        onClick: () => removeLink(index),
                        style: { marginTop: '8px' }
                    }, 'Retirer ce lien')
                ])
            ),
            // Add button
            createElement(Button, {
                key: 'add',
                variant: 'secondary',
                onClick: addLink,
                style: { marginTop: '8px' }
            }, '+ Ajouter un autre lien')
        ]);
    };

    // Main plugin component
    const GraduateLinksPlugin = () => {
        const postType = useSelect((select) => 
            select('core/editor').getCurrentPostType()
        );

        // Only render for graduate post type
        if (postType !== 'graduate') {
            return null;
        }

        return createElement(PluginDocumentSettingPanel, {
            name: 'graduate-links-panel',
            title: 'Related Links',
            className: 'graduate-links-panel'
        }, createElement(GraduateLinksPanel));
    };

    // Register the plugin
    registerPlugin('graduate-links-field', {
        render: GraduateLinksPlugin,
        icon: null
    });
})();