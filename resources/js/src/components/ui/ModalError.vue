<template>
    <div class="modal-error">
        <div class="modal-error__container">
            <div class="modal-error__header">
                <h5 class="modal-error__title">
                    Ошибка!
                </h5>
                <div class="btn-close" @click="this.$emit('close-modal')"></div>
            </div>
            <div class="modal-error__content">
                <ul class="modal-error__list">
                    <li v-for="(error, idx) in this.errors" :key="idx" class="modal-error__item">
                        {{error}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ModalError',
        props: {
            errors: {
                type: Array,
                required: true,
            }
        },
        emits: ['close-modal'],
    }
</script>

<style scoped lang="scss">
    .modal-error{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.66);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1001;
        &__container {
            width: 500px;
            height: 300px;
            max-height: 300px;
            background-color: #fff;
            border-radius: 15px;
        }
        &__header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e8e9ea;
            padding: 20px;

            .btn-close {
                font-size: 20px;
                cursor: pointer;
            }
        }

        &__title {
            margin-bottom: 0!important;
        }

        &__content {
            padding: 20px;
        }
    }
</style>
