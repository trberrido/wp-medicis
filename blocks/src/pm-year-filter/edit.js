import ServerSideRender from '@wordpress/server-side-render';

import './editor.scss';

export default function Edit() {

	return (
		<ServerSideRender block="pm/year-filter" />
	);

}