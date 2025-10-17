import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";
import { Japanese } from "flatpickr/dist/l10n/ja.js";

document.addEventListener("DOMContentLoaded", () => {
    const date = document.getElementById("study_date") as HTMLInputElement | null;
    if(date) {
        flatpickr(date, {
            dateFormat: "Y年/m月/d日",
            locale: Japanese,
            allowInput: true,
        })
    }
});
