import { reactive } from 'vue';

export default function useErrors(initialErrors = {}) {
    const errors = reactive({ ...initialErrors });

    const setErrors = (newErrors) => {
        for (const key in newErrors) {
            if (key in errors) {
                errors[key] = newErrors[key][0];
            }
        }
    };

    const hideError = (field) => {
        errors[field] = null;
    };

    return {
        errors,
        hideError,
        setErrors,
    };
}
