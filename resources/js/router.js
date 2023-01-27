import RouteMerger from '@core-modules/importers/RouteMerger';
import routeImporter from '@core-modules/importers/routeImporter';
import '@calendar/icons';

(new RouteMerger(routes))
    .add(routeImporter(require.context('@calendar/routes', false, /.*\.js$/)))
    .add(routeImporter(require.context('./routes', false, /.*\.js$/)));