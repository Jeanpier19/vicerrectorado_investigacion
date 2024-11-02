import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );

import vSelect from 'vue-select';
Vue.component('v-select', vSelect);
import 'vue-select/dist/vue-select.css';

Vue.directive('tooltip', function(el, binding){
    $(el).tooltip({
    	title: binding.value,
    	placement: binding.arg,
    	trigger: 'hover'             
    });
});

import moment from 'moment';
import 'moment/locale/es';
moment.locale('es');
Vue.filter('myDate', function(date) {
	return moment(date).format('DD/MM/YYYY');
})

import { 
  	HasError,
  	AlertError,
  	AlertErrors, 
  	AlertSuccess
} from 'vform';
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);
Vue.component(AlertSuccess.name, AlertSuccess);

import Swal from 'sweetalert2';
window.Swal = Swal;

window.toastr = require('toastr');

window.Fire = new Vue();

import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs';
Vue.use(LaravelPermissionToVueJS);

// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
Vue.component('Loading', Loading);

import 'overlayscrollbars/js/OverlayScrollbars.js';
import 'overlayscrollbars/css/OverlayScrollbars.css';

import VueTheMask from 'vue-the-mask';
Vue.use(VueTheMask);