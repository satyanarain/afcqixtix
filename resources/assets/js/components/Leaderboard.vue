<template>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ETM No. / Abstract No.</th>
                <th>Conductor (ID) / Driver (ID)</th>
                <th>Login At / Logout At</th>
                <th>Mobile No.</th>
                <th>Route-Duty-Shift</th>
                <th>Bus No.</th>
                <th>Last Ticket Issued</th>
                <th>Last Communicated</th>
                <th>GPRS Level</th>
                <th>Battery % </th>
            </tr>
        </thead>
        <tbody v-if="getRecordsCount > 0">
            <tr v-for="(data, key) in sortedData">
                <td v-bind:class="[data.etm_abstract_box_class]">{{ data.etm_abstract }}</td>
                <td v-bind:class="[data.conductor_driver_box_class]">{{ data.conductor_driver }}</td>
                <td>{{ data.login_logout }}</td>
                <td>{{ data.mobile }}</td>
                <td v-bind:class="[data.route_duty_shift_box_class]">{{ data.route_duty_shift }}</td>
                <td v-bind:class="[data.bus_box_class]">{{ data.bus }}</td>
                <td v-bind:class="[data.last_ticket_issued_box_class]">{{ data.last_ticket_issued }}</td>
                <td v-bind:class="[data.last_communicated_box_class]">{{ data.last_communicated }}</td>
                <td v-bind:class="[data.gprs_level_box_class]">{{ data.gprs_level }}</td>
                <td v-bind:class="[data.battery_percentage_box_class]">{{ data.battery_percentage }}</td>
            </tr>
        </tbody>
        <tbody v-else>
            <tr>
                <td>No item found!</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['current'],
        data() {
            return {
                data: []
            }
        },
        created() {
            //this.fetchLeaderboard();
            this.listenForChanges();
        },
        methods: {
            fetchLeaderboard() {
                axios.get('/api/v1/getetmhealthstatusdata').then((response) => {
                    this.data = response.data;
                    console.log(response.data)
                })
            },
            listenForChanges() {
                Echo.channel('etmdataupdated')
                .listen('ETMDataUpdated', (e) => {
                    console.log(e)
                    if(e.broadcastData.flag === 0)
                    {
                        var broadcastedData = e.broadcastData.data;
                        var d = this.data.find((d) => d.abstract_no === broadcastedData.abstract_no);
                        // check if status exists on table
                        if(d){
                            var index = this.data.indexOf(d);
                            this.data[index].battery_percentage = broadcastedData.battery_percentage;
                            this.data[index].battery_percentage_box_class = broadcastedData.battery_percentage_box_class;
                            this.data[index].gprs_level = broadcastedData.gprs_level;
                            this.data[index].gprs_level_box_class = broadcastedData.gprs_level_box_class;
                            this.data[index].last_communicated = broadcastedData.last_communicated;
                            this.data[index].last_communicated_box_class = broadcastedData.last_communicated_box_class;
                            this.data[index].last_ticket_issued = broadcastedData.last_ticket_issued;
                            this.data[index].last_ticket_issued_box_class = broadcastedData.last_ticket_issued_box_class;
                            this.data[index].etm_abstract = broadcastedData.etm_abstract;
                            this.data[index].etm_abstract_box_class = broadcastedData.etm_abstract_box_class;
                            this.data[index].conductor_driver_box_class = broadcastedData.conductor_driver_box_class;
                            this.data[index].conductor_driver = broadcastedData.conductor_driver;
                            this.data[index].route_duty_shift = broadcastedData.route_duty_shift;
                            this.data[index].route_duty_shift_box_class = broadcastedData.route_duty_shift_box_class;
                            this.data[index].bus = broadcastedData.bus;
                            this.data[index].bus_box_class = broadcastedData.bus_box_class;
                            this.data[index].login_logout = broadcastedData.login_logout;
                        }
                        // if not, add 'em
                        else {
                            this.data.push(broadcastedData)
                        }
                    }else{
                        this.data = e.broadcastData.data;
                    }
                })
                    
            }
        },
        computed: {
            sortedData() {
                return this.data
            },
            getRecordsCount() {
                return this.data.length
            }
        }
    }
</script>