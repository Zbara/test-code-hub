<template>
    <div>
        <select
            class="form-select"
            type="text"
            :placeholder="this.placeholder"
            ref="selectList"
            multiple
        >
            <option
                v-for="item in items"
                :value="item.value"
                :key="item.value"
            >
                {{ item.name }}
            </option>
        </select>
    </div>
</template>
<script>
import TomSelect from "tom-select";
export default {
    name: "Multiselect",
    props: {
        items: {
            type: Array,
        },
        placeholder: {
            type: String,
        },
        selectedOptions: {
            type: Object,
        },
        isError: {
            type: String,
            default: null
        },
        name: {
            type: String,
            default: null
        },
        isType: {
            type: String,
            default: null
        },
        isStatus: {
            type: Boolean,
            default: null
        }
    },
    data() {
        return {
            selectInit: {},
            isErrorSelect: false
        }
    },
    watch: {
        isError: {
            handler() {
                this.$refs.selectList.tomselect.wrapper.classList.add('is-invalid')
            }
        },
        isStatus: {
            handler() {
                this.clearSelect();
            }
        },
        selectedOptions: {
            handler() {
                this.selectInit.clear();

                for (let i = 0; i < this.selectedOptions.length; i++) {
                    this.selectInit.addItem(this.selectedOptions[i]);
                }
            }
        }
    },
    mounted() {
        this.initSelect()
    },
    methods: {
        initSelect() {
            this.selectInit = new TomSelect(this.$refs.selectList, {
                plugins: ['remove_button'],
                copyClassesToDropdown: false,
                dropdownParent: 'body',
                controlInput: '<input>',
                render: {
                    item: function (data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function (data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
                onItemAdd: (value) => {
                    this.$emit('onItem', value, this.isType, 'add');
                },
                onItemRemove: (value) => {
                    this.$emit('onItem', value, this.isType, 'remove');
                },
                onBlur: () => {

                    this.$refs.selectList.tomselect.wrapper.classList.remove('is-invalid')

                    this.$emit('hideError', this.name);
                }
            })
        },
        clearSelect() {
            this.selectInit.clear();
            this.$emit('onItem', 0, this.isType, 'clear');
        }
    }
}
</script>
