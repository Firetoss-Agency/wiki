/** Import external dependencies */
import $ from 'jquery'

/** Import UIkit */
import UIkit from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons'

/** Load Icons */
UIkit.use(Icons)

/** Import local dependencies */
import Router from './util/Router'
import site from './routes/site'
import home from './routes/home'

/** Populate Router instance with DOM routes */
const routes = new Router({
  site,
  home,
});

/** Load events */
$(document).ready(() => routes.loadEvents())
