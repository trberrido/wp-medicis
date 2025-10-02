import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import ServerSideRender from '@wordpress/server-side-render';

import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {

	const registeredMenus = useSelect((select) => {
		const menuLocations = select('core').getMenuLocations();
		return menuLocations || {};
	}, []);

	return (

			<div { ...useBlockProps() }>
		
                        <ServerSideRender
                            block="pm/palmares"
                        />
   
			</div>
	);
}
