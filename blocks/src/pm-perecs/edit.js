import {ServerSideRender} from '@wordpress/server-side-render';

export default function Edit() {

return (
	<ServerSideRender block="pm/year-filter" />
);

}