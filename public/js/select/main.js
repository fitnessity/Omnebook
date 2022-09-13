
                var cities = [
                    'Amsterdam',
                    'Antwerp',
                    'Athens',
                    'Barcelona',
                    'Berlin',
                    'Birmingham',
                    'Bradford',
                    'Bremen',
                    'Brussels',
                    'Bucharest',
                    'Budapest',
                    'Cologne',
                    'Copenhagen',
                    'Dortmund',
                    'Dresden',
                    'Dublin',
                    'DÃ¼sseldorf',
                    'Essen',
                    'Frankfurt',
                    'Genoa',
                    'Glasgow',
                    'Gothenburg',
                    'Hamburg',
                    'Hannover',
                    'Helsinki',
                    'Leeds',
                    'Leipzig',
                    'Lisbon',
                    'ÅÃ³dÅº',
                    'London',
                    'KrakÃ³w',
                    'Madrid',
                    'MÃ¡laga',
                    'Manchester',
                    'Marseille',
                    'Milan',
                    'Munich',
                    'Naples',
                    'Palermo',
                    'Paris',
                    'PoznaÅ„',
                    'Prague',
                    'Riga',
                    'Rome',
                    'Rotterdam',
                    'Seville',
                    'Sheffield',
                    'Sofia',
                    'Stockholm',
                    'Stuttgart',
                    'The Hague',
                    'Turin',
                    'Valencia',
                    'Vienna',
                    'Vilnius',
                    'Warsaw',
                    'WrocÅ‚aw',
                    'Zagreb',
                    'Zaragoza'
                ];

                var citiesByCountry = [
                    {
                        text: 'Austria',
                        children: [
                            { id: 54, text: 'Vienna' }
                        ]
                    },
                    {
                        text: 'Belgium',
                        children: [
                            { id: 2, text: 'Antwerp' },
                            { id: 9, text: 'Brussels' }
                        ]
                    },
                    {
                        text: 'Bulgaria',
                        children: [
                            { id: 48, text: 'Sofia' }
                        ]
                    },
                    {
                        text: 'Croatia',
                        children: [
                            { id: 58, text: 'Zagreb' }
                        ]
                    },
                    {
                        text: 'Czech Republic',
                        children: [
                            { id: 42, text: 'Prague' }
                        ]
                    },
                    {
                        text: 'Denmark',
                        children: [
                            { id: 13, text: 'Copenhagen' }
                        ]
                    },
                    {
                        text: 'England',
                        children: [
                            { id: 6, text: 'Birmingham' },
                            { id: 7, text: 'Bradford' },
                            { id: 26, text: 'Leeds' },
                            { id: 30, text: 'London' },
                            { id: 34, text: 'Manchester' },
                            { id: 47, text: 'Sheffield' }
                        ]
                    },
                    {
                        text: 'Finland',
                        children: [
                            { id: 25, text: 'Helsinki' }
                        ]
                    },
                    {
                        text: 'France',
                        children: [
                            { id: 35, text: 'Marseille' },
                            { id: 40, text: 'Paris' }
                        ]
                    },
                    {
                        text: 'Germany',
                        children: [
                            { id: 5, text: 'Berlin' },
                            { id: 8, text: 'Bremen' },
                            { id: 12, text: 'Cologne' },
                            { id: 14, text: 'Dortmund' },
                            { id: 15, text: 'Dresden' },
                            { id: 17, text: 'DÃ¼sseldorf' },
                            { id: 18, text: 'Essen' },
                            { id: 19, text: 'Frankfurt' },
                            { id: 23, text: 'Hamburg' },
                            { id: 24, text: 'Hannover' },
                            { id: 27, text: 'Leipzig' },
                            { id: 37, text: 'Munich' },
                            { id: 50, text: 'Stuttgart' }
                        ]
                    },
                    {
                        text: 'Greece',
                        children: [
                            { id: 3, text: 'Athens' }
                        ]
                    },
                    {
                        text: 'Hungary',
                        children: [
                            { id: 11, text: 'Budapest' }
                        ]
                    },
                    {
                        text: 'Ireland',
                        children: [
                            { id: 16, text: 'Dublin' }
                        ]
                    },
                    {
                        text: 'Italy',
                        children: [
                            { id: 20, text: 'Genoa' },
                            { id: 36, text: 'Milan' },
                            { id: 38, text: 'Naples' },
                            { id: 39, text: 'Palermo' },
                            { id: 44, text: 'Rome' },
                            { id: 52, text: 'Turin' }
                        ]
                    },
                    {
                        text: 'Latvia',
                        children: [
                            { id: 43, text: 'Riga' }
                        ]
                    },
                    {
                        text: 'Lithuania',
                        children: [
                            { id: 55, text: 'Vilnius' }
                        ]
                    },
                    {
                        text: 'Netherlands',
                        children: [
                            { id: 1, text: 'Amsterdam' },
                            { id: 45, text: 'Rotterdam' },
                            { id: 51, text: 'The Hague' }
                        ]
                    },
                    {
                        text: 'Poland',
                        children: [
                            { id: 29, text: 'ÅÃ³dÅº' },
                            { id: 31, text: 'KrakÃ³w' },
                            { id: 41, text: 'PoznaÅ„' },
                            { id: 56, text: 'Warsaw' },
                            { id: 57, text: 'WrocÅ‚aw' }
                        ]
                    },
                    {
                        text: 'Portugal',
                        children: [
                            { id: 28, text: 'Lisbon' }
                        ]
                    },
                    {
                        text: 'Romania',
                        children: [
                            { id: 10, text: 'Bucharest' }
                        ]
                    },
                    {
                        text: 'Scotland',
                        children: [
                            { id: 21, text: 'Glasgow' }
                        ]
                    },
                    {
                        text: 'Spain',
                        children: [
                            { id: 4, text: 'Barcelona' },
                            { id: 32, text: 'Madrid' },
                            { id: 33, text: 'MÃ¡laga' },
                            { id: 46, text: 'Seville' },
                            { id: 53, text: 'Valencia' },
                            { id: 59, text: 'Zaragoza' }
                        ]
                    },
                    {
                        text: 'Sweden',
                        children: [
                            { id: 22, text: 'Gothenburg' },
                            { id: 49, text: 'Stockholm' }
                        ]
                    }
                ];

                var transformText = $.fn.select3.transformText;

                // example query function that returns at most 10 cities matching the given text
                function queryFunction(query) {
                    var term = query.term;
                    var offset = query.offset || 0;
                    var results = cities.filter(function(city) {
                        return transformText(city).indexOf(transformText(term)) > -1;
                    });
                    results.sort(function(a, b) {
                        a = transformText(a);
                        b = transformText(b);
                        var startA = (a.slice(0, term.length) === term),
                            startB = (b.slice(0, term.length) === term);
                        if (startA) {
                            return (startB ? (a > b ? 1 : -1) : -1);
                        } else {
                            return (startB ? 1 : (a > b ? 1 : -1));
                        }
                    });
                    setTimeout(query.callback({
                        more: results.length > offset + 10,
                        results: results.slice(offset, offset + 10)
                    }), 500);
                }

                $('#single-input').select3({
                    allowClear: true,
                    placeholder: 'No city selected',
                    query: queryFunction,
                    searchInputPlaceholder: 'Type to search a city'
                });

                $('#single-input-with-labels').select3({
                    allowClear: true,
                    items: citiesByCountry,
                    placeholder: 'No city selected',
                    searchInputPlaceholder: 'Type to search a city'
                });

                $('#multiple-input').select3({
                    multiple: true,
                    placeholder: 'Type to search cities',
                    query: queryFunction
                });

                $('#tags-input').select3({
                    items: ['red', 'green', 'blue'],
                    multiple: true,
                    tokenSeparators: [' '],
                    value: ['brown', 'red', 'green']
                });

                $('#emails-input').select3({
                    inputType: 'Email',
                    placeholder: 'Type or paste email addresses'
                });
            