import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
import { Tooltip, initTWE } from "tw-elements";
initTWE({ Tooltip });

Alpine.start();
