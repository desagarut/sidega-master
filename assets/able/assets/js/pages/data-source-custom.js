$(document).ready(function() {
    setTimeout(function() {

        // [ dom table ]
        $('#dom-table').DataTable();

        // [ Javascript source table ]
        var dataSet = [
            ["Tiger Nixon", "System Architect", "Edinburgh", "5421", "2011/04/25", "$320,800"],
            ["Garrett Winters", "Accountant", "Tokyo", "8422", "2011/07/25", "$170,750"],
            ["Ashton Cox", "Junior Technical Author", "San Francisco", "1562", "2009/01/12", "$86,000"],
            ["Cedric Kelly", "Senior Javascript Developer", "Edinburgh", "6224", "2012/03/29", "$433,060"],
            ["Airi Satou", "Accountant", "Tokyo", "5407", "2008/11/28", "$162,700"],
            ["Brielle Williamson", "Integration Specialist", "New York", "4804", "2012/12/02", "$372,000"],
            ["Herrod Chandler", "Sales Assistant", "San Francisco", "9608", "2012/08/06", "$137,500"],
            ["Rhona Davidson", "Integration Specialist", "Tokyo", "6200", "2010/10/14", "$327,900"],
            ["Colleen Hurst", "Javascript Developer", "San Francisco", "2360", "2009/09/15", "$205,500"],
            ["Sonya Frost", "Software Engineer", "Edinburgh", "1667", "2008/12/13", "$103,600"],
            ["Jena Gaines", "Office Manager", "London", "3814", "2008/12/19", "$90,560"],
            ["Quinn Flynn", "Support Lead", "Edinburgh", "9497", "2013/03/03", "$342,000"],
            ["Charde Marshall", "Regional Director", "San Francisco", "6741", "2008/10/16", "$470,600"],
            ["Haley Kennedy", "Senior Marketing Designer", "London", "3597", "2012/12/18", "$313,500"],
            ["Tatyana Fitzpatrick", "Regional Director", "London", "1965", "2010/03/17", "$385,750"],
            ["Michael Silva", "Marketing Designer", "London", "1581", "2012/11/27", "$198,500"],
            ["Paul Byrd", "Chief Financial Officer (CFO)", "New York", "3059", "2010/06/09", "$725,000"],
            ["Gloria Little", "Systems Administrator", "New York", "1721", "2009/04/10", "$237,500"],
            ["Bradley Greer", "Software Engineer", "London", "2558", "2012/10/13", "$132,000"],
            ["Dai Rios", "Personnel Lead", "Edinburgh", "2290", "2012/09/26", "$217,500"],
        ];
        
		$('#jsource-table').DataTable({
            data: dataSet,
            columns: [{
                    title: "Name"
                },
                {
                    title: "Position"
                },
                {
                    title: "Office"
                },
                {
                    title: "Extn."
                },
                {
                    title: "Start date"
                },
                {
                    title: "Salary"
                }
            ]
        });

    }, 350);
});
