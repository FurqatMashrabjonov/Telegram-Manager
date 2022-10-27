import Swal from "sweetalert2";
import {inject} from 'vue'

let swal = inject('$swal')
const flash = {
    flash: (message) => {
        swal.fire({
            position: 'top-end',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 1500
        }).then(r => () => {
            console.log(r)
        })
    }
}


export default flash
