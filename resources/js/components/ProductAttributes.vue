<template>
    <div>
        <div class="size-group_item" v-for="(row, index) in rows">
                <input type="text" id="size_name" :value="row.type" class="form-control" :name="'size[' + index + '][name]'"
                       placeholder="Название размера">
                <input type="text" id="size_count" :value="row.count" class="form-control" :name="'size[' + index + '][count]'"
                       placeholder="Количество">
                <select :name="'size[' + index + '][colors]'" class="js-example-basic-multiple" multiple="multiple">
                    <option value="red">Красный</option>
                    <option value="pink">Розовый</option>
                    <option value="blue">Синий</option>
                    <option value="green">Зеленый</option>
                    <option value="white">Белый</option>
                    <option value="black">Черный</option>
                </select>
                <button @click="removeRow" type="button" class="btn-danger"><i class="fas fa-trash"></i></button>
                <button @click="addRow" id="addRow" type="button" class="btn-success"><i class="fas fa-plus"></i></button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                rows: [
                    {type: 's', count: 140, colors: 'red, black, white'},
                    {type: 'm', count: 50, colors: 'red, black, white'}
                ]
            }
        },

        methods: {
            addRow: function () {
                try {
                    this.rows.push({});
                    $(document).ready(function () {
                        $('.js-example-basic-multiple').select2();
                    });
                } catch (e) {
                    console.log(e);
                }
            },
            removeRow: function () {
                if (this.rows.length > 1) {
                    this.rows.pop();
                }
            }
        }
    }
</script>
