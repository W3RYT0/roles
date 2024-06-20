import {Alpine, Livewire} from '../../vendor/livewire/livewire/dist/livewire.esm';
import ToastComponent from '../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts';
import './bootstrap';
Alpine.plugin(ToastComponent)
Livewire.start()

