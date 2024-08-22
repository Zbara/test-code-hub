<template>
    <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark" v-if="this.currentUser">
        <div class="container-fluid">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark">
                <RouterLink :to="{name: 'main'}">
                    Test Work
                </RouterLink>
            </h1>
            <div class="navbar-nav flex-row d-lg-none">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                        <span class="avatar avatar-sm">{{ this.currentUser?.data.email[0] ?? '' }}</span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ this.currentUser.data.email }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a @click.prevent="logOut" class="dropdown-item cursor-pointer">Выход</a>
                    </div>
                </div>
            </div>
            <div class="navbar-collapse collapse toggled hide" id="sidebar-menu">
                <ul class="navbar-nav pt-lg-3 p-3">
                    <li class="nav-item">
                        <RouterLink :to="{name: 'main'}" class="nav-link">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <IconHome/>
                            </span>
                            <span class="nav-link-title">
                                Главная
                            </span>
                        </RouterLink>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none" v-if="this.currentUser">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                        <span class="avatar avatar-sm">{{ currentUser.data.email[0] }}</span>
                        <div class="d-none d-xl-block ps-2">
                            <div> {{ currentUser.data.email }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a @click.prevent="logOut" class="dropdown-item cursor-pointer">Выход</a>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse">
                <Breadcrumb v-bind:headersBreadcrumb="headersBreadcrumb"/>
            </div>
        </div>
    </header>
</template>
<script>
import {
    IconBuildingStore,
    IconUsers,
    IconBrandTelegram,
    IconRobot,
    IconHome,
    IconCloudSearch,
    IconTool,
    IconCash,
    IconHelp,
    IconLeaf,
    IconRadioactiveFilled,
    IconMoon,
    IconSun,
    IconBell,
    IconCarSuv,
    IconUserStar,
    IconNetwork,
    IconTruckDelivery
} from '@tabler/icons-vue';
import {tooltip} from "@/core/libs/tooltip.js";
import {ref} from 'vue';
import TooltipWrapper from './TooltipWrapper.vue';
import Breadcrumb from './Breadcrumb.vue';

export default {

    data() {
        return {
        }
    },

    components: {
        IconBuildingStore,
        IconCash,
        IconUsers,
        IconBrandTelegram,
        IconRobot,
        IconHome,
        IconTool,
        IconHelp,
        IconRadioactiveFilled,
        IconLeaf,
        IconCloudSearch,
        IconMoon,
        IconSun,
        IconNetwork,
        IconBell,
        IconCarSuv,
        IconUserStar,
        IconTruckDelivery,
        Breadcrumb,
        'v-tooltip': TooltipWrapper,
    },

    props: {
        headersBreadcrumb: {
            type: Array
        }
    },

    computed: {
        currentUser() {
            return this.$store.state.auth.user;
        },
    },
    setup() {
        const tooltipOptions = ref({
            delay: {show: 50, hide: 50},
            html: false, // Установите значение true, если это необходимо
            placement: 'auto', // Установите желаемое значение расположения
        });

        return {
            tooltipOptions,
        };
    },
    mounted() {
        tooltip();
    },
    methods: {
        logOut() {
            this.$store.dispatch('auth/logout');
            this.$router.push('/login');
        },
    }
}
</script>
