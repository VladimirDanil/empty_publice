<template>
    <div class="main-layout-wrapper">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-12">
                <div class="main-layout-card">
                    <div class="main-layout-card-header-with-button">
                        <div class="main-layout-card-content-wrapper">
                            <div class="main-layout-card-header-contents">
                                <h5 class="no-margin">{{ $t('lang.bookings') }}</h5>
                            </div>
                            <div class="main-layout-card-header-contents float-right">
                                <a class="btn btn-primary app-color mobile-btn" href="#" @click="newBooking">{{
                                    $t('lang.new_booking') }}</a>
                            </div>
                        </div>
                    </div>
                    <datatable-component class="main-layout-card-content" :options="tableOptions"></datatable-component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axiosGetPost from '../../helper/axiosGetPostCommon';

    export default {
        extends: axiosGetPost,
        data() {
            let instance = this;
            return {
                item: [0],
                totalBooking: 0,
                confirmBooking: 0,
                pendingBooking: 0,
                cancelBooking: 0,
                status: 0,
                from: 0,
                to: 0,
                hidePreloader: '',
                preloaderType: 'load',
                tableOptions: {
                    tableName: 'booking',
                    columns: [
                        {title: 'lang.id', key: 'id', type: 'text', sortable: true},
                        {title: 'lang.service', key: 'title', type: 'text', sortable: true},
                        {
                            title: 'lang.status', key: 'status', type: 'custom',
                            modifier: function (rowData) {

                                if (rowData == 'confirmed') return {
                                    value: instance.$t('lang.confirmed_'),
                                    class: "booking-status bg-success"
                                };
                                else if (rowData == 'pending') return {
                                    value: instance.$t('lang.pending'),
                                    class: "booking-status bg-warning"
                                };
                                else if (rowData == 'canceled') return {
                                    value: instance.$t('lang.canceled'),
                                    class: "booking-status bg-secondary"
                                };
                            }
                        },
                        {title: 'lang.book_date', key: 'booking_date', type: 'text', sortable: true},
                        {title: 'lang.time', key: 'booking_time', type: 'array', sortable: false},
                        {title: 'lang.quantity', key: 'quantity', type: 'text', sortable: true},
                        {title: 'lang.bill', key: 'booking_bill', type: 'text', sortable: true},
                        {
                            title: 'lang.payment_status', key: 'payment_status', type: 'custom', sortable: false,
                            modifier: function (rowData) {
                                if (rowData === 'paid') return {
                                    value: instance.$t('lang.paid'),
                                    class: "booking-status bg-success"
                                };
                                else return {
                                    value: instance.$t('lang.due'),
                                    class: "booking-status bg-danger"
                                };
                            }

                        },
                    ],
                    source: '/dashboard-client-bookings/',
                    sortingOrder: 'DESC',
                    search: false,
                    formatting: ['booking_bill'],
                    filters: [
                        {
                            title: 'lang.status', key: 'status', type: 'dropdown', options: [
                                {text: 'lang.all', value: 0, selected: true},
                                {text: 'lang.confirmed_', value: 1},
                                {text: 'lang.pending', value: 2},
                                {text: 'lang.canceled', value: 3}
                            ]
                        },
                        {title: 'lang.date_range', key: 'date_range', type: 'date_range'},

                    ]
                }
            }
        },
        created() {
            this.getData('/clientdashboarddata');
        },
        mounted() {
            let instance = this;
            $('select');
            $('#status').on('change', function () {
                let value = $(this).val();
                instance.status = value
                instance.readData();
            });
        },
        methods:
            {
                newBooking() {
                    let instance = this;
                    instance.redirect('/');
                },

                getPreloader: function (e, f) {
                    this.preloaderType = e;
                    this.hidePreloader = f;
                },
                getData(route) {
                    let instance = this;
                    this.axiosGet(route,
                        function (response) {
                            instance.item = response.data;
                            instance.totalBooking = instance.item.totalBooking;
                            instance.confirmBooking = instance.item.confirmBooking;
                            instance.pendingBooking = instance.item.pendingBooking;
                            instance.cancelBooking = instance.item.cancelBooking;
                        },
                        function (response) {
                        },
                    );
                },
                getDatefilterValue: function (fromDate, toDate) {
                    this.from = fromDate;
                    this.to = toDate;
                    this.setPreloader('load', '');
                    this.readData();
                },
            }
    }
</script>
