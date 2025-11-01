<section id="familychart" class="bg-gradient-to-b from-gray-50 to-white py-12">
    <div class="px-4 mx-auto max-w-screen-xl lg:px-6 font-poppins">
        <!-- Header -->
        <div class="mx-auto text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Family Tree Chart
            </h2>
            <p class="text-gray-500 sm:text-lg max-w-2xl mx-auto">
                Visualisasi garis keturunan keluarga besar <span class="font-semibold text-gray-700">Abd Azis</span>.
            </p>
        </div>

        <!-- Family Tree Container -->
        <div
            class="relative bg-white/70  border-gray-200 rounded-2xl shadow-lg overflow-hidden">
            <div id="family-tree-wrapper" class="overflow-auto touch-none relative p-4 border-t border-gray-100"
                style="touch-action: none;">
                <div class="flex justify-center">
                    <div id="family-tree" class="chart"></div>
                </div>
            </div>

            @auth
                <div
                    class="flex justify-center items-center w-full py-6 bg-gradient-to-r from-blue-50 via-white to-blue-50">
                    {{-- <a href="{{ route('family.index') }}"
                        class="flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl shadow-md transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah Anggota
                    </a> --}}

                    <a href="{{ route('family.index') }}"
                        class="group bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3 px-7 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out flex items-center gap-2">
                        <span
                            class="transform group-hover:translate-x-1 transition-transform duration-300 ease-in-out text-lg"><svg
                                class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                    clip-rule="evenodd" />
                            </svg></span>
                        <span>Tambah Anggota</span>

                    </a>
                </div>


            @endauth
        </div>
    </div>
</section>

<style>
    .chart {
        min-height: 600px;
        transform-origin: center center;
        transition: transform 0.3s ease;
    }

    /* Node Styling */
    .node {
        padding: 12px 18px;
        border: 2px solid #CBD5E1;
        border-radius: 14px;
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
        font-weight: 600;
        font-size: 14px;
        color: #1F2937;
        text-align: center;
        text-transform: capitalize;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.25s ease;
        max-width: 240px;
    }

    .Treant>.node:hover {
        transform: scale(1.05) translateY(-3px);
        z-index: 5;
        background: linear-gradient(135deg, #E0F2FE 0%, #ffffff 100%);
        border-color: #3B82F6;
        box-shadow: 0 8px 16px rgba(59, 130, 246, 0.25);
    }

    /* Connector lines */
    .Treant>.connector {
        stroke: #94A3B8 !important;
        stroke-width: 2px;
    }

    /* Mobile Responsive */
    @media (max-width: 640px) {
        .node {
            font-size: 12px;
            max-width: 160px;
            padding: 8px 12px;
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
            levelSeparation: 60,
            siblingSeparation: 40,
            subTeeSeparation: 70,
            nodeAlign: "BOTTOM",
            connectors: {
                type: "curve",
                style: {
                    "stroke": "#94A3B8",
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
                name: "Silsilah Keluarga"
            },
            children: @json($treeData)
        }
    };

    new Treant(family_chart_config);
</script>
