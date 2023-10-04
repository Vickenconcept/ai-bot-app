import './bootstrap';
import axios from 'axios';
import notification from './notification';


import Alpine from 'alpinejs'
Alpine.data('notification', notification);
 
window.Alpine = Alpine
 
Alpine.start()
