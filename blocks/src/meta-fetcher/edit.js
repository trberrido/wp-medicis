import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	Panel,
    PanelBody,
    SelectControl
} from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';

import { useEntityProp } from '@wordpress/core-data';

import './editor.scss';

export default function Edit({ attributes, setAttributes, context }) {

    const [meta, setMeta] = useEntityProp('postType', context.postType, 'meta', context.postId);
	const metaKeys = meta ? Object.keys(meta).filter(key => key.startsWith('pm__')) : [];
console.log(context, meta)
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
							...Object.keys(meta).map(meta => ({ label: meta, value: meta}))
						] }
						onChange={ onChangeMetaKey }
					/>
					</PanelBody>
				</Panel>
			</InspectorControls>

			<div>
				{
					attributes.selectedMenu ?
						<ServerSideRender
							block="pm/meta-fetcher"
							attributes={attributes}
						/>
					:
						<p>Select a meta</p>
				}
			</div>
		</div>
	); 
}