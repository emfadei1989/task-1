<template>
    <div id="editableField">
        <i v-on:click="toggleEdit()" class="fa fa-edit"></i>
        <div class="content">

            <div v-show="!editMode" class="field" v-text="inputValue">

            </div>

            <div v-show="editMode" class="input">
                <input :name="initialInputName" :type="initialInputType" v-model="inputValue">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            initialInputValue: {
                type: String,
                required: true
            },
            initialInputName: {
                type: String,
                required: true
            },
            initialInputType: {
                type: String,
                required: true
            },
            initialUrl: {
                type: String,
                required: true
            },
            initialMethod: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                editMode: false,
                inputValue: this.initialInputValue,
                inputName: this.initialInputName
            }
        },

        methods: {
            toggleEdit: function () {
                this.editMode = !this.editMode;
                if (!this.editMode) {
                    this.sendData();
                }
            },
            sendData: function () {
                let me = this;

                let inputName = me.initialInputName;
                let sendData = {
                    [inputName]: me.inputValue
                };
                axios.request({
                    url: me.initialUrl,
                    method: me.initialMethod,
                    data: sendData
                }).then(res => {
                    if (!res.data.success) {
                        alert('Произошла ошибка при обновлении объекта!');
                    }
                }).catch(err => {
                    alert('Произошла ошибка при обновлении объекта!');
                })
            }
        }

    }
</script>

<style lang="scss" scoped>
    #editableField {
        display: inline-block;
        position: relative;
        padding: 2px 14px 0 0;
        .fa {
            cursor: pointer;
            position: absolute;
            right: 0;
            top: 0;
        }
    }

</style>