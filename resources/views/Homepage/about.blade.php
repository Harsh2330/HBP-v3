@include('layouts.nav')
<head>
    <!-- Removed custom CSS file link -->
</head>
<div class="container mx-auto p-4">
    <section class="info-section">
        <h2 class="text-2xl font-bold mb-4">Our Mission</h2>
        <section class="info-section">
            <img src="\image\abut-us\IMG_1262-removebg-preview.png" alt="" class="w-72 h-auto mb-4">
            <img src="\image\abut-us\IMG_1175.png" alt="doctor" class="mb-4 mx-auto">
            <p class="foundation-info text-left font-serif font-bold text-lg">
                Deepak Foundation was initiated in 1982 with a vision of providing healthcare facilities to the families of workers and local communities residing in the industrial area of Nandesari. The Foundation has progressed over the period into a leading non-profit civil society. With a Pan-India presence, it has branch offices in Pune, Roha, Palghar and Aurangabad in Maharashtra, Hyderabad in Telengana, Dumri, Arki, Kuchai and Madhuban in Jharkhand, and New Delhi.
            </p>
            <p class="foundation-info text-left font-serif text-lg">
                Creating a socially inclusive and sustainable environment among the underprivileged communities by providing services in the area of healthcare, education, skills building & livelihood, and disability & special needs. We envisage a world free of distress, disease, deprivation, exploitation and subjugation, ensuring the overall well-being of the family, society and community.
            </p>
            <p class="foundation-info text-left font-serif text-lg">
                The overall goal of Foundation is to empower women by providing healthcare and livelihood opportunities in order to improve maternal and child health, reduce poverty and build capacity in the areas of public health and livelihood promotion, and provide an inclusive environment for children with special needs.
            </p>
        </section>
    </section>
</div>
<div class="container mx-auto p-4">
    <!-- Information Section -->
    <section class="info-section">
        <div class="flex items-center gap-5">
            <img src="\image\abut-us\IMG_0977.png" alt="" class="flex-shrink-0 w-112 h-auto animate-float">
            <div>
                <p class="text-left">
                    Introduction: Every patient has the fundamental right to receive a good quality of care at the place where he/she lives. A home is a place of memories, familiarity and safety, a place where we remain comfortable, relaxed and confident and the best place for freedom of choice and autonomy. It is possible to manage patients with advanced diseases at home.
                </p>
                <ul class="list-disc list-inside text-left">
                    <li>Initiate the delivery of Care services in semi urban and urban areas of Vadodara</li>
                    <li>Develop a helpline for connecting and counselling the care givers, patients, relatives to the Care facility</li>
                    <li>Reduce the out-of-pocket expenditure while accessing Care facilities</li>
                    <li>Promote the utilization of public healthcare services and social security schemes</li>
                    <li>Improve the palliative health care seeking and awareness on Care facilities available</li>
                    <li>To deliver compassionate, patient-centred Care at home.</li>
                    <li>To provide emotional and psychological support to patients and caregivers.</li>
                </ul>
            </div>
        </div>
        <div class="flex items-center gap-5 mt-4">
            <div id="info-section">
                <p class="text-left">
                    Establishment of affordable, accessible and quality Care facilities in the community will reduce the hospitalization of patients with incurable illnesses. This will be a welcome step as people will be at home during the end-stage of their lives. Establishment of quality community-based health-care services at a home level will provide emotional and spiritual support and helps in preventing and minimising complications in bed-ridden patients. This can be done in partnership with the family/ neighbourhood/ local community as they have a keen interest in the wellbeing of the patient.
                </p>
                <p class="text-left">
                    End of life Care patients are mostly bedridden and cannot come to an OPD of a hospital. Such patients will need to be cared for at a hospice or their homes. Since most of our patients prefer to be cared at homes, home care services should be provided. Home based Care has several additional advantages for the patient and family such as comfort, privacy, familiarity with surroundings, security, autonomy and a greater degree of independence. It is also cost effective and as it does not entail travelling to the hospital repeatedly for follow up visits and unnecessary investigations and treatments.
                </p>
            </div>
            <img src="\image\abut-us\IMG_1041.png" alt="" class="flex-shrink-0 w-112 h-auto animate-float">
        </div>
    </section>
    
    <!-- Our Team Section -->
    <div class="container mx-auto p-4">
        <section class="info-section">
            <h2 class="text-2xl font-bold mb-4 text-center">Meet Our Team</h2>
            <div class="relative">
                <button class="scroll-button left absolute left-0 top-1/2 transform -translate-y-1/2" onclick="scrollTeamMembers(-1)">&#10094;</button>
                <div class="team-members flex overflow-x-auto" id="team-members">
                    <div class="team-member flex-shrink-0 w-64 p-4">
                        <img src="https://upload.wikimedia.org/wikipedia/en/1/18/Benedict_Cumberbatch_as_Doctor_Strange.jpeg" alt="Team Member 1" class="w-40 h-40 rounded-full mx-auto object-cover">
                        <h3 class="text-center mt-2">Dr. Dhruve</h3>
                        <p class="text-center">Chief Medical Officer</p>
                    </div>
                    <div class="team-member flex-shrink-0 w-64 p-4">
                        <img src="https://preview.redd.it/do-yall-think-well-see-more-of-scarlet-witch-after-secret-v0-dvvfoevgmyxc1.jpeg?width=640&crop=smart&auto=webp&s=460f7561eefd51f81a759f2bc1d29141b8e8cec6" alt="Team Member 2" class="w-40 h-40 rounded-full mx-auto object-cover">
                        <h3 class="text-center mt-2">Dr. Sakshi</h3>
                        <p class="text-center">Head of Patient Support</p>
                    </div>
                    <div class="team-member flex-shrink-0 w-64 p-4">
                        <img src="\image\abut-us\tarun.JPG" alt="Team Member 4" class="w-40 h-40 rounded-full mx-auto object-cover">
                        <h3 class="text-center mt-2">Dr. Tarun Machhi</h3>
                        <p class="text-center">Therapist</p>
                    </div>
                </div>
                <button class="scroll-button right absolute right-0 top-1/2 transform -translate-y-1/2" onclick="scrollTeamMembers(1)">&#10095;</button>
            </div>
        </section>
    </div>
</div>
@include('layouts.footer')


