import { createToast, withProps } from 'mosha-vue-toastify';
//import CustomizedContent from "./CustomizedContent.vue";
import 'mosha-vue-toastify/dist/style.css';

class ToastService {
    showToast(message) {
        //createToast(withProps(CustomizedContent, { yourFavProp: 'bruh' }))
         createToast(message, { type: 'success', toastBackgroundColor: "#4f46e5", hideProgressBar: false, showIcon: true})
         //alert('hello')
    }
}

export default new ToastService();
