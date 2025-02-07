@include('layouts.nav')

<style>
    html, body {
        height: 100%;
        margin: 0;
    }
    body {
        display: flex;
        flex-direction: column;
    }
    main {
        flex: 1;
    }
    img, video {
        max-width: 100%;
        height: auto;
    }
    @media (min-width: 768px) {
        img, video {
            max-width: 30%;
        }
    }
</style>
<main class="p-8">
    <img src="/image/logo.png.png" alt="Logo" class="w-full md:w-72 h-auto mt-[-1rem]">
    <img src="/image/patient.png" alt="patient" class="w-full md:w-[750px] h-auto float-none md:float-right ml-0 md:ml-8 mt-4 md:mt-0"> <!-- Shifted the patient image to the right side -->        
    <div class="mt-[-2rem]"> <!-- Moved the first paragraph upward -->
        <p class="max-w-2xl h-auto md:h-[500px] mx-auto text-lg leading-relaxed text-justify p-4 bg-transparent rounded-lg overflow-y-auto">
        Home-based palliative care is a specialized medical service providing comprehensive support to individuals with serious, life-limiting illnesses at home, focusing on enhancing quality of life by addressing physical, emotional, social, and spiritual needs through a multidisciplinary team delivering personalized care.<br>
        <br>
        <br>
        ઘરઆધારિત પેલિયેટિવ કેર એ આરોગ્યસેવાની એવી સેવા છે જે ગંભીર, દીર્ઘકાળિન અથવા અંતિમ ચરણની બિમારીઓ ધરાવતા દર્દીઓને તેમના ઘરની આરામદાયક પરિસ્થિતિમાં પૂરી પાડવામાં આવે છે. તેનું મુખ્ય ઉદ્દેશ્ય દર્દીઓ અને તેમના પરિવારજનોની શારીરિક, ભાવનાત્મક, સામાજિક અને આધ્યાત્મિક જરૂરિયાતોને ધ્યાનમાં રાખીને તેમની જીવનની ગુણવત્તામાં સુધારો લાવવાનો છે.
        </p>
    </div>
</main>
@include('layouts.footer')