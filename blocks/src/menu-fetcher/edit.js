import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { Panel, PanelBody, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import ServerSideRender from '@wordpress/server-side-render';

import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {

	const registeredMenus = useSelect((select) => {
		const menuLocations = select('core').getMenuLocations();
		return menuLocations || {};
	}, []);

	return (
		<Fragment>
			<InspectorControls key='Settings'>
				<Panel>
					<PanelBody initialOpen={ true } title='Select menu'>
					<SelectControl
						label="Menus list"
						value={ attributes.selectedMenu }
						options={[
							{ label: 'Select a Menu', value: '' },
							...Object.entries(registeredMenus).map( ([key, value]) => ( { label: value.description, value: value.name } ) )
						]}
						onChange={(selectedMenu) => setAttributes({ selectedMenu })}
					/>
					</PanelBody>
				</Panel>
			</InspectorControls>

			<div { ...useBlockProps() }>
				{
					attributes.selectedMenu ?
                        <ServerSideRender
                            block="pm/menu-fetcher"
                            attributes={attributes}
                        />
                	:
                        <p>Select a menu</p>
				}
			</div>
		</Fragment>
	);
}
