@include('layouts.nav')
<head>
    <link rel="stylesheet" href="/css/index3.css">
</head>
<div class="container">
    <section class="info-section">
        <h2>Our Mission</h2>
        <section class="info-section">
            <img src="\image\abut-us\IMG_1262-removebg-preview.png" alt="" style="width: 300px; height: auto;">
            <br><br>
            <img src="\image\abut-us\IMG_1175.JPG" alt="doctor"><br><br><br>
            <p class="foundation-info" style="text-align: left; font-family: 'Times New Roman', Times, serif; font-weight: bold; font-size: 1.2rem;">Deepak Foundation was initiated in 1982 with a vision of providing healthcare facilities to the families of workers and local communities residing in the industrial area of Nandesari. The Foundation has progressed over the period into a leading non-profit civil society. With a Pan-India presence, it has branch offices in Pune, Roha, Palghar and Aurangabad in Maharashtra, Hyderabad in Telengana, Dumri, Arki, Kuchai and Madhuban in Jharkhand, and New Delhi.
                Creating a socially inclusive and sustainable environment among the underprivileged communities by providing services in the area of healthcare, education, skills building & livelihood, and disability & special needs. We envisage a world free of distress, disease, deprivation, exploitation and subjugation, ensuring the overall well-being of the family, society and community. The overall goal of Foundation is to empower women by providing healthcare and livelihood opportunities in order to improve maternal and child health, reduce poverty and build capacity in the areas of public health and livelihood promotion, and provide an inclusive environment for children with special needs.
            </p> 
        </section>
    </section>
</div>
<div class="container">
    <!-- Information Section -->
    <section class="info-section">
        <section class="info-section">
            <div style="display: flex; align-items: center; gap: 20px;"></div>
            <div style="display: flex; align-items: center; gap: 20px;">
                <img src="\image\abut-us\IMG_0977.JPG" alt="" style="flex-shrink: 0; width: 450px; height: auto; animation: float 2s ease-in-out infinite;">
                <div>
                    <p style="text-align: left;">Introduction Every patient has the fundamental right to receive a good quality of care at the place where he/she lives. A home is a place of memories, familiarity and safety, a place where we remain comfortable, relaxed and confident and the best place for freedom of choice and autonomy. It is possible to manage patients with advanced diseases at home.</p>
                    <p style="text-align: left;">1.Initiate the delivery of Care services in semi urban and urban areas of Vadodara
2.	Develop a helpline for connecting and counselling the care givers, patients, relatives to the Care facility
3.	Reduce the out-of-pocket expenditure while accessing Care facilities
4.	Promote the utilization of public healthcare services and social security schemes
5.	Improve the palliative health care seeking and awareness on Care facilities available
6.	To deliver compassionate, patient-centred Care at home.

7.	To provide emotional and psychological support to patients and caregivers.

</p>
                </div>
            </div>
            <div>
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div id="info-section">
                        <p>Establishment of affordable, accessible and quality Care facilities in the community will reduce the hospitalization of patients with incurable illnesses. This will be a welcome step as people will be at home during the end-stage of their lives. Establishment of quality community-based health-care services at a home level will provide emotional and spiritual support and helps in preventing and minimising complications in bed-ridden patients. This can be done in partnership with the family/ neighbourhood/ local community as they have a keen interest in the wellbeing of the patient.  </p>
                        <p>End of life Care patients are mostly bedridden and cannot come to an OPD of a hospital. Such patients will need to be cared for at a hospice or their homes. Since most of our patients prefer to be cared at homes, home care services should be provided. Home based Care has several additional advantages for the patient and family such as comfort, privacy, familiarity with surroundings, security, autonomy and a greater degree of independence. It is also cost effective and as it does not entail travelling to the hospital repeatedly for follow up visits and unnecessary investigations and treatments.</p>
                    </div>
                    <img src="\image\abut-us\IMG_1041.JPG" alt="" style="flex-shrink: 0; width: 450px; height: auto; animation: float 2s ease-in-out infinite;">
                </div>
            </div>
        </section>
    </section>
    
    <!-- Our Team Section -->
    <div class="container">
        <section class="info-section">
            <section class="info-section">
                <h2>Meet Our Team</h2>
                <img src="\image\abut-us\IMG_0917.PNG" alt="" style="width: 800px; height: auto;">
                <button class="scroll-button left" onclick="scrollTeamMembers(-1)">&#10094;</button>
                <button class="scroll-button right" onclick="scrollTeamMembers(1)">&#10095;</button>
                <div class="team-members" id="team-members">
                    <div class="team-member">
                        <img src="https://upload.wikimedia.org/wikipedia/en/1/18/Benedict_Cumberbatch_as_Doctor_Strange.jpeg" alt="Team Member 1">
                        <h3>Dr. Dhruve</h3>
                        <p>Chief Medical Officer</p>
                    </div>

                    <div class="team-member">
                        <img src="https://preview.redd.it/do-yall-think-well-see-more-of-scarlet-witch-after-secret-v0-dvvfoevgmyxc1.jpeg?width=640&crop=smart&auto=webp&s=460f7561eefd51f81a759f2bc1d29141b8e8cec6" alt="Team Member 2">
                        <h3>Dr. Sakshi</h3>
                        <p>Head of Patient Support</p>
                    </div>

                    <div class="team-member">
                        <img src="\image\abut-us\tarun.JPG" alt="Team Member 4">
                        <h3>Dr.Tarun Machhi</h3>
                        <p>rapist</p>
                    </div>
                    
                   
                </div>
            </section>
        </section>
        </div>
    </div>
    @include('layouts.footer')


