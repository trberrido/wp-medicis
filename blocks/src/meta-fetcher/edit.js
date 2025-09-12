import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	Panel,
    PanelBody,
    SelectControl
} from '@wordpress/components';
import { ServerSideRender } from '@wordpress/server-side-render';

import { useSelect } from '@wordpress/data';
import './editor.scss';

export default function Edit({ attributes, setAttributes, context }) {

	const { postMetaKeys, isLoading } = useSelect((select) => {

		const { getEntityRecords, getEntityRecord, hasFinishedResolution } = select('core');
		
		const posts = getEntityRecords('postType', context.postType, {
			per_page: 1,
			_fields: 'id',
		});
		
		const firstPost = posts?.[0]?.id;
		
		let postMeta = null;
		let isLoadingMeta = true;
		
		if ( firstPost ){
			const post = getEntityRecord('postType', context.postType, firstPost);
			postMeta = post?.meta;
			isLoadingMeta = !hasFinishedResolution('getEntityRecord', ['postType', context.postType, firstPost]);
		}
		
		const isLoadingPosts = !hasFinishedResolution('getEntityRecords', ['postType', context.postType, { per_page: 1, _fields: 'id' }]);
		
		return {
			postMetaKeys: postMeta,
			isLoading: isLoadingPosts || isLoadingMeta
		};
	}, []);

	if (isLoading) {
		return <div { ...useBlockProps() }>Loading...</div>;
	}

    const onChangeMetaKey = (newMetaKey) => {
        setAttributes({ metaKey: newMetaKey });
    };

	return (
		<div { ...useBlockProps() }>
			<InspectorControls key='Settings'>
				<Panel>
					<PanelBody initialOpen={ true } title='Select meta key'>
					<SelectControl
						label="Meta keys list"
						value={ attributes.metaKey }
						options={ [
							{ label: 'Select a Meta', value: '' },
							...Object.keys(postMetaKeys).map(meta => ({ label: meta, value: meta}))
						] }
						onChange={ onChangeMetaKey }
					/>
					</PanelBody>
				</Panel>
			</InspectorControls>

			<div>meta content {attributes.metaKey}</div>
		</div>
	);  

}