import { createToast, withProps } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';

class ToastService {

    showToast(message) {
         createToast(message, { type: 'success', toastBackgroundColor: "#4f46e5", hideProgressBar: false, showIcon: true})
    }
}

export default new ToastService();
