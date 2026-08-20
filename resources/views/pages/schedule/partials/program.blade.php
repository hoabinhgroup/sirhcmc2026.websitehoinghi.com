<!-- Program Schedule Section Begin -->
<section class="schedule-table-section spad program-schedule-section" x-data="{ day: '1' }">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        @if (route('schedule') !== request()->url())
          <div class="section-title">
            <h2>CHƯƠNG TRÌNH DỰ KIẾN</h2>
            <p>TENTATIVE PROGRAM</p>
          </div>
        @endif
        <div class="schedule-table-tab program-schedule-tab">
          <div class="switch-language program-day-switch">
            <button @click="day = '1'" :class="{ 'active': day === '1' }" class="button-day1" type="button">
              <strong>Day 1</strong>
              <span>16th October</span>
            </button>
            <button @click="day = '2'" :class="{ 'active': day === '2' }" class="button-day2" type="button">
              <strong>Day 2</strong>
              <span>17th October</span>
            </button>
          </div>
          <div class="program-top-image">
            <img src="{{ Storage::url('img/banner web-01.jpg') }}" alt="Program Top">
          </div>
          <div class="program-tab-panels">

            {{-- ===== DAY 1: 16th October 2026 ===== --}}
            <div x-show="day === '1'" x-cloak>
              <div class="schedule-table-content program-table-wrap">
                <table class="program-table">
                  <thead>
                    <tr>
                      <th class="program-th program-th--time">Time</th>
                      <th class="program-th program-th--ballroom1">Ballroom 1</th>
                      <th class="program-th program-th--ballroom2">Ballroom 2</th>
                      <th class="program-th program-th--ballroom3">Ballroom 3</th>
                    </tr>
                  </thead>
                  <tbody>

                    {{-- 08.00 - 11.30 --}}
                    <tr>
                      <td class="event-time">08.00 - 11.30</td>
                      <td class="program-cell program-cell--ballroom1">
                        <h5>PRE-CONFERENCE CME: VASCULAR MALFORMATIONS</h5>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">ISSVA classification
                                for vascular malformation and pathology aspects</span> <span class="talk-speaker">- MD.
                                Michel Wassef</span></li>
                            <li><span class="talk-title">Molecular genetic
                                and histopathology of vascular malformations</span> <span class="talk-speaker">- Prof.
                                Guillaume Canaud</span></li>
                            <li><span class="talk-title">Clinical and Imaging
                                assessment of vascular malformations</span> <span class="talk-speaker">- Prof. Luke
                                Toh</span></li>
                            <li><span class="talk-title">Prenatal diagnosis
                                and treatment of CVM</span> <span class="talk-speaker">- MD. Antoine Fraissenon</span>
                            </li>
                            <li><span
                                class="talk-title talk-break">Break</span></li>
                            <li><span class="talk-title">Interventional
                                Radiology role in management of slow flow vascular malformations</span> <span
                                class="talk-speaker">- Prof. Luke Toh</span></li>
                            <li><span class="talk-title">Radiological
                                diagnosis and treatment of CVM in children in France</span> <span class="talk-speaker">-
                                MD. Antoine Fraissenon</span></li>
                            <li><span class="talk-title">Management of
                                slow-flow vascular malformations: medical management, sclerotherapy (alcohol,
                                others)</span> <span class="talk-speaker">- MD. Nguyen Dinh Luan</span></li>
                            <li><span class="talk-title">Reversible
                                electroporation for slow-flow vascular malformations: indication, probe selection,
                                technique and outcomes</span> <span class="talk-speaker">- MD. Martin Krauss</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom2">
                        <h5>PRE-CONFERENCE CME: ABLATION</h5>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Lung tumor ablation</span> <span class="talk-speaker">- PhD.
                                MD. Cung Van Cong</span></li>
                            <li><span class="talk-title">The current development of non-thermal tumor ablation in
                                Asia</span> <span class="talk-speaker">- Prof. Huang Kai Wen</span></li>
                            <li><span class="talk-title">RFA/MWA for hepatic tumor</span> <span class="talk-speaker">-
                                PhD. MD. Vo Hoi Trung Truc</span></li>
                            <li><span class="talk-title">Thyroid Ablation</span> <span class="talk-speaker">- MD. Tran
                                Quy Tuong</span></li>
                            <li><span class="talk-title">Combination of TACE and MWA for treatment of intermediate
                                HCC</span> <span class="talk-speaker">- MD. Nguyen Tan Tai</span></li>
                            <li><span class="talk-title">Application of fusion imaging in liver tumor ablation</span>
                              <span class="talk-speaker">- PhD. MD. Le Van Khang</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom3">
                        <h5>ORAL PRESENTATION</h5>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Endovascular treatment of cerebral aneurysms using
                                intrasaccular flow disruptors (WEB, LUNA...)</span></li>
                            <li><span class="talk-title">Initial outcomes of stent-assisted coiling with Pegasus stent
                                for ruptured wide-necked cerebral aneurysms: A case series at Cho Ray Hospital</span>
                            </li>
                            <li><span class="talk-title">Endovascular treatment of foramen magnum dural arteriovenous
                                fistulas (dAVFs): A report of two rare cases</span></li>
                            <li><span class="talk-title">Outcomes of middle meningeal artery (MMA) embolization for
                                recurrences at Cho Ray Hospital: A case series</span></li>
                            <li><span class="talk-title">An overview of intra-arterial chemotherapy for the brain: Where
                                do we stand?</span></li>
                            <li><span class="talk-title">Adrenal vein sampling: experience at People's Hospital
                                115</span> <span class="talk-speaker">- MD Do Quoc Huy</span></li>
                            <li><span class="talk-title">No-reflow phenomenon after endovascular thrombectomy in acute
                                ischemic stroke patients</span> <span class="talk-speaker">- MD Nguyen Quang Hien</span>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>

                    {{-- 11.30 - 12.30 Lunch --}}
                    <tr>
                      <td class="event-time">11.30 - 12.30</td>
                      <td colspan="3" class="program-cell program-cell--lunch">
                        <h5>LUNCH SYMPOSIUM</h5>
                      </td>
                    </tr>

                    {{-- 13.00 - 14.30 --}}
                    <tr>
                      <td class="event-time">13.00 - 14.30</td>
                      <td class="program-cell program-cell--ballroom1">
                        <h5>NON-VASCULAR INTERVENTION</h5>
                        <p class="program-chairman">Chairman: Assoc. Prof. Le Trong Binh | Assoc. Prof. Nguyen Thai Binh
                        </p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Percutaneous Cholecystostomy: practical techniques</span> <span
                                class="talk-speaker">- Assoc. Prof. Nakarin Inmutto</span></li>
                            <li><span class="talk-title">Controversies in the percutaneous transhepatic intervention for
                                unresectable malignant hilar biliary obstruction</span> <span class="talk-speaker">-
                                Assoc. Prof. Le Trong Binh</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom2">
                        <h5>HCC</h5>
                        <p class="program-chairman">Chairman: Prof. Mai Trong Khoa | Assoc. Prof. Le Thanh Dung | MD.
                          Amanda Rigas</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">HCC 2026: Key Updates Every Interventional Radiologist Should
                                Know</span> <span class="talk-speaker">- MD. Amanda Rigas</span></li>
                            <li><span class="talk-title">The Interventionalist's Third Eye: Cone-Beam CT in the Era of
                                Superselective TACE for HCC</span> <span class="talk-speaker">- Assoc. Prof. Kittipitch
                                Bannangkoon</span></li>
                            <li><span class="talk-title">Radiation segmentectomy using Y90</span> <span
                                class="talk-speaker">- MD. Farah Gillan Irani</span></li>
                            <li><span class="talk-title">Management of HCC, learning from failures</span> <span
                                class="talk-speaker">- MD. Ngo Le Lam</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom3">
                        <h5>ORAL PRESENTATION (English - Contest)</h5>
                      </td>
                    </tr>

                    {{-- 14.30 - 15.00 Tea Breaks --}}
                    <tr>
                      <td class="event-time">14.30 - 15.00</td>
                      <td colspan="3" class="program-cell program-cell--shared">
                        <h5>TEA BREAKS</h5>
                      </td>
                    </tr>

                    {{-- 15.30 - 17.00 --}}
                    <tr>
                      <td class="event-time">15.30 - 17.00</td>
                      <td class="program-cell program-cell--ballroom1">
                        <h5>EMBOLIZATION</h5>
                        <p class="program-chairman">Chairman: Prof. Hiroshi Kondo | MD. Nguyen Ngoc Cuong</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Emergency IR for Hemorrhage Control</span> <span
                                class="talk-speaker">- Prof. Hiroshi Kondo</span></li>
                            <li><span class="talk-title">Endovascular management of splenic artery aneurysms</span>
                              <span class="talk-speaker">- MD. Farah Gillan Irani</span></li>
                            <li><span class="talk-title">Update on renal artery embolization for treatment of resistant
                                hypertension in ESRD patients</span> <span class="talk-speaker">- A.Prof. Nguyen Xuan
                                Hien</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom2">
                        <h5>PELVIC INTERVENTION</h5>
                        <p class="program-chairman">Chairman: Assoc. Prof. Nguyen Xuan Hien | MD. Avi Beck | Assoc.
                          Prof. Vo Tan Duc</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Uterine Artery Embolization for fibroids / adenomyosis /
                                obstetrical scenarios</span> <span class="talk-speaker">- MD. Avi Beck</span></li>
                            <li><span class="talk-title">Endovascular intervention for men's problems</span> <span
                                class="talk-speaker">- MD. Chun Yu Lin</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom3">
                        <h5>STROKE</h5>
                        <p class="program-chairman">Chairman: Assoc. Prof. Nguyen Huy Thang | Assoc. Prof. Vu Dang Luu |
                          MD. Nguyen Duc Khang</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">The optimal recanalisation therapy for acute ischemic
                                stroke</span> <span class="talk-speaker">- Assoc. Prof. Nguyen Huy Thang</span></li>
                            <li><span class="talk-title">An 8-year review of endovascular thrombectomy for cerebral
                                venous sinus thrombosis at Cho Ray Hospital</span></li>
                          </ul>
                        </div>
                      </td>
                    </tr>

                    {{-- 18.30 - 21.30 Welcome Dinner --}}
                    <tr>
                      <td class="event-time">18.30 - 21.30</td>
                      <td colspan="3" class="program-cell program-cell--dinner">
                        <h5>WELCOME DINNER</h5>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>

            {{-- ===== DAY 2: 17th October 2026 ===== --}}
            <div x-show="day === '2'" x-cloak>
              <div class="schedule-table-content program-table-wrap">
                <table class="program-table">
                  <thead>
                    <tr>
                      <th class="program-th program-th--time">Time</th>
                      <th class="program-th program-th--ballroom1">Ballroom 1</th>
                      <th class="program-th program-th--ballroom2">Ballroom 2</th>
                      <th class="program-th program-th--ballroom3">Ballroom 3</th>
                    </tr>
                  </thead>
                  <tbody>

                    {{-- 08.00 - 09.30 --}}
                    <tr>
                      <td class="event-time">08.00 - 09.30</td>
                      <td class="program-cell program-cell--ballroom1">
                        <h5>AVF / PAD / PERIPHERAL VENOUS SYSTEM</h5>
                        <p class="program-chairman">Chairman: MD. Farah Gillan Irani | MD. Nguyen Tan Tai</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">One Patient, One Circulation: The Interplay Between PAD and
                                ESRD</span> <span class="talk-speaker">- MD. Amanda Rigas</span></li>
                            <li><span class="talk-title">PAD: procedural strategies - achieving true lumen access for
                                iliac and femoropopliteal lesions without IVUS</span> <span class="talk-speaker">- MD.
                                Farah Gillan Irani</span></li>
                            <li><span class="talk-title">Endovascular management of LEDVT in cancer patients</span>
                              <span class="talk-speaker">- Assoc. Prof. Le Trong Binh</span></li>
                            <li><span class="talk-title">Tips and Tricks to overcome in complex peripheral
                                intervention</span> <span class="talk-speaker">- A.Prof. Hoang Minh Loi</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom2">
                        <h5>PAIN MANAGEMENT</h5>
                        <p class="program-chairman">Chairman: Assoc. Prof. Bui Van Giang | MD. Nguyen Anh Tuan | MD. Avi
                          Beck</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Pain Management: Image-guided nerve blocks and neurolysis,
                                celiac plexus blocks, sphenopalatine blocks</span> <span class="talk-speaker">- MD. Avi
                                Beck</span></li>
                            <li><span class="talk-title">Role of pterygopalatine ganglion blockage in treatment of
                                facial pain</span> <span class="talk-speaker">- MD. Nguyen Anh Tuan</span></li>
                            <li><span class="talk-title">Hypogastric Plexus Alcohol Neurolysis for Pain Management in
                                Advanced Cancer</span> <span class="talk-speaker">- MD Trinh Tu Tam</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom3">
                        <h5>DAVF / BRAIN AVM</h5>
                        <p class="program-chairman">Chairman: MD. Joseph Gammete | MD. Tran Quoc Tuan | Assoc. Prof.
                          Nguyen Trong Tuyen</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Functional Venous Assessment in Transverse-Sigmoid Sinus DAVFs:
                                How it guides Endovascular Treatment Strategy</span> <span class="talk-speaker">- MD.
                                Nguyen Quang Anh</span></li>
                            <li><span class="talk-title">Management of Chronic Subdural Hematoma: The Role of
                                Endovascular Intervention and Surgery</span> <span class="talk-speaker">- MD Nguyen Minh
                                Duc</span></li>
                            <li><span class="talk-title">Traumatic carotid-cavernous fistula with ipsilateral parent
                                artery occlusion: What is the optimal treatment strategy?</span></li>
                          </ul>
                        </div>
                      </td>
                    </tr>

                    {{-- 09.30 - 10.00 Tea Breaks --}}
                    <tr>
                      <td class="event-time">09.30 - 10.00</td>
                      <td colspan="3" class="program-cell program-cell--shared">
                        <h5>TEA BREAKS</h5>
                      </td>
                    </tr>

                    {{-- 10.00 - 11.30 Opening + Plenary --}}
                    <tr>
                      <td class="event-time">10.00 - 11.30</td>
                      <td colspan="3" class="program-cell program-cell--shared">
                        <h5>OPENING CEREMONY &amp; PLENARY SESSION</h5>
                        <p class="program-chairman">Chairman: Prof. Pham Minh Thong | Assoc. Prof. Vu Dang Luu | MD.
                          Nguyen Dinh Luan | Assoc. Prof. Le Thanh Dung</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title talk-break">Opening
                                Ceremony</span></li>
                            <li><span class="talk-title">AI &amp; IR (Tri tue nhan tao va Dien quang can thiep)</span>
                              <span class="talk-speaker">- Assoc. Prof. Hoang Minh Loi</span></li>
                            <li><span class="talk-title">Global Training: Beyond Case Numbers - Competency-Based
                                Training in Interventional Radiology</span> <span class="talk-speaker">- MD. Amanda
                                Rigas (SIR)</span></li>
                            <li><span class="talk-title">Role of IR in Pediatric</span> <span class="talk-speaker">-
                                Prof. Murthy Chennapragada</span></li>
                          </ul>
                        </div>
                      </td>
                    </tr>

                    {{-- 11.30 - 12.30 Lunch --}}
                    <tr>
                      <td class="event-time">11.30 - 12.30</td>
                      <td colspan="3" class="program-cell program-cell--lunch">
                        <h5>LUNCH SYMPOSIUM</h5>
                      </td>
                    </tr>

                    {{-- 13.00 - 14.30 --}}
                    <tr>
                      <td class="event-time">13.00 - 14.30</td>
                      <td class="program-cell program-cell--ballroom1">
                        <h5>PORTAL HYPERTENSION - CONSENSUS</h5>
                        <p class="program-chairman">Chairman: Assoc. Prof. Le Thanh Dung | MD. Nguyen Dinh Luan</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">B-RTO</span> <span class="talk-speaker">- Prof. Masanori
                                Inoue</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom2">
                        <h5>ABLATION</h5>
                        <p class="program-chairman">Chairman: Prof. Huang Kai Wen | MD. Ngo Le Lam | MD. Chun Yu Lin</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Renal cryoablation</span> <span class="talk-speaker">- MD. Avi
                                Beck</span></li>
                            <li><span class="talk-title">Combined embolization and ablation therapy in liver and
                                kidney</span> <span class="talk-speaker">- MD. Chun Yu Lin</span></li>
                            <li><span class="talk-title">Cryoablation of lung tumor</span> <span class="talk-speaker">-
                                Prof. Masanori Inoue</span></li>
                            <li><span class="talk-title">Percutaneous Thermal Ablation in the Management of Bone
                                Metastases</span> <span class="talk-speaker">- Prof. Nicolas Stacoffe</span></li>
                            <li><span class="talk-title">Microwave ablation for uterine fibroid</span> <span
                                class="talk-speaker">- MD Tran Quy Tuong</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom3">
                        <h5>ANEURYSM / MISCELLANEOUS</h5>
                        <p class="program-chairman">Chairman: Assoc. Prof. Vu Dang Luu | Assoc. Prof. Anchalee Churojana
                          | MD. Nguyen Huynh Nhat Tuan</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Management of Aneurysm by FDS</span> <span
                                class="talk-speaker">- MD. Nguyen Huynh Nhat Tuan</span></li>
                            <li><span class="talk-title">Management of Ruptured Aneurysm at Quang Tri General
                                Hospital</span> <span class="talk-speaker">- MD. Phung Hung</span></li>
                            <li><span class="talk-title">Transradial access for neurointerventions: Updates on recent
                                advances</span></li>
                          </ul>
                        </div>
                      </td>
                    </tr>

                    {{-- 14.30 - 15.00 Tea Breaks --}}
                    <tr>
                      <td class="event-time">14.30 - 15.00</td>
                      <td colspan="3" class="program-cell program-cell--shared">
                        <h5>TEA BREAKS</h5>
                      </td>
                    </tr>

                    {{-- 15.00 - 16.30 --}}
                    <tr>
                      <td class="event-time">15.00 - 16.30</td>
                      <td class="program-cell program-cell--ballroom1">
                        <h5>INNOVATION</h5>
                        <p class="program-chairman">Chairman: Assoc. Prof. Vu Dang Luu | Assoc. Prof. Le Thanh Dung |
                          MD. Nguyen Dinh Luan</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">The Role of Interventional Radiology in Orthopedic and
                                Musculoskeletal Disorders</span> <span class="talk-speaker">- MD. Joris Lavigne</span>
                            </li>
                            <li><span class="talk-title">Reversible electroporation for AVMs: the new gold
                                standard?</span> <span class="talk-speaker">- MD. Martin Krauss</span></li>
                            <li><span class="talk-title">The principle of irreversible electroporation</span> <span
                                class="talk-speaker">- Prof. Huang Kai Wen</span></li>
                            <li><span class="talk-title">Clinic pull, technology push - Innovations for
                                Interventions</span> <span class="talk-speaker">- Prof. Xiang Jun</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom2">
                        <h5>M&amp;M</h5>
                        <p class="program-chairman">Chairman: Prof. Masanori Inoue | MD. Ngo Le Lam</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Managing Difficult IR Cases in a Hybrid OR</span> <span
                                class="talk-speaker">- MD. Wu Chih Horng</span></li>
                            <li><span class="talk-title">My nightmare cases at M&amp;M session</span> <span
                                class="talk-speaker">- Prof. Masanori Inoue</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom3">
                        <h5>TECHNICIAN &amp; NURSE</h5>
                        <p class="program-chairman">Chairman: Assoc. Prof. Le Thanh Thao | Assoc. Prof. Dang Vinh Hiep |
                          Technician Thai Van Loc</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Building a pediatric IR service - the road less
                                travelled</span> <span class="talk-speaker">- MD. Kevin Fung</span></li>
                            <li><span class="talk-title">Hemostasis efficacy and complications of mechanical radial
                                artery compression after percutaneous coronary intervention</span> <span
                                class="talk-speaker">- Technician Tran Ba Khoa</span></li>
                            <li><span class="talk-title">Optimization of a 3.0T MRI Protocol to improve image quality in
                                patients after endovascular coil embolization of intracranial aneurysms</span> <span
                                class="talk-speaker">- Technician Le Thanh Phong</span></li>
                            <li><span class="talk-title">Education and Clinical Training of Interventional Radiologic
                                Technologists in Taiwan</span> <span class="talk-speaker">- Technician Liu
                                Yu-Ping</span></li>
                            <li><span class="talk-title">Advancing Beyond Conventional Competency: Cultivating
                                Multidimensional, Future-Ready Competencies in Interventional Technologists</span> <span
                                class="talk-speaker">- Technician Lu Yen-Ho</span></li>
                            <li><span class="talk-title">The Pivotal Role of Interventional Radiology Nurses in Acute
                                Endovascular Thrombectomy (EVT): Workflow Standardization, Patient Safety, and Quality
                                Management</span> <span class="talk-speaker">- Technician Chen Yin-Ting</span></li>
                          </ul>
                        </div>
                      </td>
                    </tr>

                    {{-- 16.30 - 17.30 --}}
                    <tr>
                      <td class="event-time">16.30 - 17.30</td>
                      <td class="program-cell program-cell--ballroom1">
                        <h5>CONSENSUS FOR IR MANAGEMENT OF PORTAL HYPERTENSION</h5>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Current Status of TIPS Procedure in Taiwan</span> <span
                                class="talk-speaker">- MD. Wu Chih Horng</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom2">
                        <h5>VASCULAR MALFORMATIONS</h5>
                        <p class="program-chairman">Chairman: MD. Nguyen Huu Kim An | MD. Nguyen Ngoc Cuong</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Systematic review of efficacy and safety of Sirolimus in the
                                treatment of congenital lymphatic malformation</span> <span class="talk-speaker">- MD.
                                Nguyen Huu Kim An</span></li>
                            <li><span class="talk-title">From a single patient to a US FDA approved drug: the story of a
                                drug repositioning for overgrowth syndrome and vascular malformations</span> <span
                                class="talk-speaker">- Prof. Guillaume Canaud</span></li>
                            <li><span class="talk-title">Bones AVM: Recognition and strategy to embolize</span> <span
                                class="talk-speaker">- MD. Nguyen Ngoc Cuong</span></li>
                          </ul>
                        </div>
                      </td>
                      <td class="program-cell program-cell--ballroom3">
                        <h5>MSK</h5>
                        <p class="program-chairman">Chairman: Prof. Nicolas Stacoffe | MD. Nguyen Truong Giang | MD.
                          Nguyen Ngoc Trang</p>
                        <div class="program-detail-list">
                          <ul>
                            <li><span class="talk-title">Transarterial Microembolization (TAME) for Musculoskeletal
                                Conditions</span> <span class="talk-speaker">- MD. Panat Nisityotakul</span></li>
                            <li><span class="talk-title">Pushing the Boundaries of Percutaneous Osteosynthesis in
                                Interventional Radiology</span> <span class="talk-speaker">- Prof. Nicolas
                                Stacoffe</span></li>
                          </ul>
                        </div>
                      </td>
                    </tr>

                    {{-- 18.30 - 21.30 Gala Dinner --}}
                    <tr>
                      <td class="event-time">18.30 - 21.30</td>
                      <td colspan="3" class="program-cell program-cell--dinner">
                        <h5>GALA DINNER</h5>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Program Schedule Section End -->