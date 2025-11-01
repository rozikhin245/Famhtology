@extends('FamilyMembers.index')

@section('section')
    <div class="w-full  mb-8">
        <div class="mt-6 sm:mt-10">
            <div class="bg-transparent rounded-2xl overflow-auto relative">
                <div id="family-tree-wrapper" class="overflow-auto touch-none relative" style="touch-action: none;">
                    <div id="family-tree" class="chart min-w-[600px] w-full"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .chart {
            min-height: 600px;
            transform-origin: 0 0;
            transition: transform 0.2s ease;
        }

        .control-btn {
            width: 40px;
            height: 40px;
            background-color: white;
            color: #4B5563;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
            transition: background 0.2s ease, box-shadow 0.2s ease;
        }

        .control-btn:hover {
            background-color: #f3f4f6;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }


        .node {
            padding: 10px 16px;
            border: 2px solid #4B5563;
            /* abu gelap */
            border-radius: 12px;
            background: #F9FAFB;
            /* abu sangat terang */
            font-weight: 600;
            font-size: 14px;
            text-transform: capitalize;
            color: #1F2937;
            /* abu gelap */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s ease, background 0.2s ease, border 0.2s ease;
            max-width: 240px;
            text-align: center;
        }

        .Treant>.node:hover {
            transform: scale(1.05);
            z-index: 2;
            background: #E5E7EB;
            /* hover abu terang */
            border-color: #374151;
            /* border lebih gelap saat hover */
        }

        @media (max-width: 640px) {
            .node {
                font-size: 13px;
                max-width: 180px;
            }

            .chart {
                min-height: 400px;
            }
        }
    </style>

    <script src="{{ asset('treant/raphael.js') }}"></script>
    <script src="{{ asset('treant/Treant.js') }}"></script>

    <script>
        var family_chart_config = {
            chart: {
                container: "#family-tree",
                levelSeparation: 50,
                siblingSeparation: 30,
                subTeeSeparation: 60,
                nodeAlign: "BOTTOM",
                connectors: {
                    type: "curve",
                    style: {
                        "stroke": "#4B5563",
                        "arrow-end": "block-wide-long"
                    }
                },
                node: {
                    HTMLclass: "node"
                },
                animateOnInit: true,
                animation: {
                    nodeAnimation: "easeOutBounce",
                    nodeSpeed: 700,
                    connectorsAnimation: "bounce",
                    connectorsSpeed: 700
                }
            },
            nodeStructure: {
                text: {
                    name: "Silsilah Keluarga Besar Bani Abd Aziz Kertorueno"
                },
                children: @json($treeData)
            }
        };

        new Treant(family_chart_config);
    </script>
@endsection
