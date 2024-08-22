<template>
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Инвентарь
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none" v-if="items.length < 5">
                        <div class="d-flex">
                            <button @click="this.$refs.modalAddItem.show()" class="btn btn-primary">
                                Добавить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">


                    <div class="col-sm-6 col-lg-4" v-for="item in items">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div>{{ item.name }}</div>
                                        <div class="text-secondary">Позиция: {{ item.position }}</div>


                                            <select class="form-select" @change="changePosition(item, $event.target.value)">
                                                <option
                                                    v-for="number in 5"
                                                    :key="number"
                                                    :value="number"
                                                    :selected="number === item.position"
                                                >
                                                    {{ number }}
                                                </option>
                                            </select>

                                    </div>


                                    <div class="ms-auto">
                                        <div class="text-secondary cursor-pointer" @click="deleteItem(item)">
                                            <IconTrash class="icon cursor-pointer" width="24" height="24"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <AddItemModal ref="modalAddItem" :items="itemsData" @add-new-item="addNewItem"/>
</template>

<script>
import axiosClient from "@/core/axios-client.js";
import AddItemModal from "@/pages/AddItemModal.vue";
import {IconTrash} from '@tabler/icons-vue';

export default {
    name: "Main",
    components: {AddItemModal, IconTrash},
    data() {
        return {
            headerProps: [],
            items: [],
            itemsData: [],
        }
    },
    mounted() {
        this.$emit('changeHeaderData', this.headerProps);

        axiosClient.get('/api/game/getItems').then(({data}) => {


            this.itemsData = data.data;
            this.getInventory();
        }).catch(error => {
            console.log(error);
        })
    },

    methods: {
        getInventory() {
            this.items = [];

            axiosClient.get('/api/game/getInventory').then(({data}) => {
                for (const item of data.data) {
                    this.items.push({
                        id: item.item_id,
                        name: item.item.name,
                        item_id: item.id,
                        position: item.position
                    });
                }
            })
        },
        addNewItem(id, itemNumber) {
            const el = this.itemsData.find(x => x.id === id);

            if (!el) {
                alert('Ошибка элемент не найден.')

                return;
            }
            axiosClient.post('/api/game/addItem', {
                item_id: id,
                position: itemNumber
            }).then(({data}) => {
                const result = data.data;

                this.items.push({
                    id: id,
                    name: el.name,
                    item_id: result.id,
                    position: result.position
                });

            });
        },
        deleteItem(item) {
            axiosClient.delete('/api/game/deleteItem', {
                params: {
                    item_id: item.item_id
                }
            }).then(() => {
                this.getInventory();
            });
        },
        changePosition(item, position) {
            axiosClient.post('/api/game/changePosition', {
                item_id: item.item_id,
                position: position
            }).then(() => {
                this.getInventory();
            });
        }
    }
}
</script>

<style scoped>

</style>
