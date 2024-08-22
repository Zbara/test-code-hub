<template>
    <div class="modal modal-blur fade" ref="modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered  modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Редактирование пользователя</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" @submit.prevent="addNewItem" id="addItems">

                    <div class="mb-3">
                        <label class="form-label">Выберите предмет:</label>
                        <div>
                            <select class="form-select" v-model="id">
                                <option v-for="item in items" :key="item" :value="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Позиция:</label>
                        <div>
                            <select class="form-select" v-model="itemNumber">
                                <option v-for="number in 5" :key="number">
                                    {{ number }}
                                </option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Закрыть
                    </a>
                    <button class="btn btn-primary ms-auto" form="addItems">
                        Добавить
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {Modal} from "bootstrap";
export default {
    name: "AddItemModal",
    data() {
        return {
            modal: null,
            id: 1,
            itemNumber: 1
        };
    },
    props: {
        items: Array,
    },
    mounted() {
        this.modal = new Modal(this.$refs.modal);
    },
    methods: {
        show() {
            this.modal.show();
        },
        hide() {
            this.modal.hide();
        },
        addNewItem() {
            this.$emit('add-new-item', this.id, this.itemNumber);
            this.hide();
        },
    }
}
</script>
