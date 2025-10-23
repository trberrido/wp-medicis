import { useBlockProps } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';

import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {

	return (

			<div { ...useBlockProps() }>
		
						<ServerSideRender
							block="pm/excerpt-free"
						/>
   
			</div>
	);
}