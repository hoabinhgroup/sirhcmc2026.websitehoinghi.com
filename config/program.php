<?php

/*
|--------------------------------------------------------------------------
| Chương trình hội nghị (nguồn: Agenda details - SIRHCM 2026 Updated 24Sep.xlsx)
|--------------------------------------------------------------------------
|
| rows[].type: sessions (3 phòng), lunch (3 phòng), shared (gộp 3 phòng), break, dinner.
| items[].break = true: dòng nghỉ / thảo luận, hiển thị in nghiêng.
|
*/

return [
    'days' => [
        [
            'label' => 'Day 1',
            'date' => '16th October',
            'rooms' => ['Ha Noi', 'Da Nang', 'Sai Gon'],
            'rows' => [
                [
                    'time' => '08.00 - 11.30',
                    'type' => 'sessions',
                    'cells' => [
                        [
                            'title' => 'Pre-conference CME of Vascular malformations',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Nguyen Dinh Luan, MD', 'Prof. Guillaume Canaud', 'Prof. Luke Toh'],
                                ],
                                [
                                    'label' => 'Panelists',
                                    'names' => ['Michel Wassef, MD', 'Huynh Thi Ngoc Van, MD', 'Martin Krauss, MD', 'Nguyen Huu Kim An, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '08:00 - 08:20',
                                    'title' => 'ISSVA classification for vascular malformations and pathology aspects',
                                    'speaker' => 'Michel Wassef, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:20 - 08:40',
                                    'title' => 'Molecular genetics and histopathology of vascular malformations',
                                    'speaker' => 'Prof. Guillaume Canaud',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:40 - 09:00',
                                    'title' => 'Clinical and imaging assessment of vascular malformations',
                                    'speaker' => 'Prof. Luke Toh',
                                    'break' => false,
                                ],
                                [
                                    'time' => '09:00 - 09:20',
                                    'title' => 'Prenatal diagnosis and treatment of CVM',
                                    'speaker' => 'Huynh Thi Ngoc Van, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '09:30 - 10:00',
                                    'title' => 'Break',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                                [
                                    'time' => '10:00 - 10:20',
                                    'title' => 'Interventional Radiology\'s role in management of slow-flow vascular malformations',
                                    'speaker' => 'Prof. Luke Toh',
                                    'break' => false,
                                ],
                                [
                                    'time' => '10:20 - 10:40',
                                    'title' => 'Radiological diagnosis and treatment of CVM in children in France',
                                    'speaker' => 'Huynh Thi Ngoc Van, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '10:40 - 11:00',
                                    'title' => 'Management of slow-flow vascular malformations: medical management, sclerotherapy (alcohol, others)',
                                    'speaker' => 'Nguyen Dinh Luan, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '11:00 - 11:30',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        null,
                        [
                            'title' => 'Pre-conference CME of Ablation',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['PhD. Cung Van Cong, MD', 'Prof. Huang Kai Wen', 'PhD. Le Van Khang, MD'],
                                ],
                                [
                                    'label' => 'Panelists',
                                    'names' => ['PhD. Vo Hoi Trung Truc, MD', 'Tran Quy Tuong, MD', 'Nguyen Tan Tai, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '08:30 - 08:50',
                                    'title' => 'Lung tumor ablation',
                                    'speaker' => 'PhD. Cung Van Cong, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:50 - 09:10',
                                    'title' => 'The current development of non-thermal tumor ablation in Asia',
                                    'speaker' => 'Prof. Huang Kai Wen',
                                    'break' => false,
                                ],
                                [
                                    'time' => '09:10 - 09:30',
                                    'title' => 'RFA/MWA for hepatic tumor',
                                    'speaker' => 'PhD. Vo Hoi Trung Truc, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '09:30 - 10:00',
                                    'title' => 'Break',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                                [
                                    'time' => '10:00 - 10:20',
                                    'title' => 'Thyroid ablation',
                                    'speaker' => 'Tran Quy Tuong, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '10:20 - 10:40',
                                    'title' => 'Combination of TACE and MWA for treatment of intermediate HCC',
                                    'speaker' => 'Nguyen Tan Tai, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '10:40 - 11:00',
                                    'title' => 'Application of fusion imaging in liver tumor ablation',
                                    'speaker' => 'PhD. Le Van Khang, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '11:00 - 11:30',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'time' => '11.30 - 12.30',
                    'type' => 'lunch',
                    'cells' => [
                        [
                            'title' => 'Lunch symposium',
                            'roles' => [],
                            'items' => [],
                        ],
                        [
                            'title' => 'Lunch symposium - UIH AVIVA',
                            'roles' => [],
                            'items' => [],
                        ],
                        [
                            'title' => 'Lunch symposium - Công nghệ An Pha',
                            'roles' => [],
                            'items' => [],
                        ],
                    ],
                ],
                [
                    'time' => '13.00 - 14.30',
                    'type' => 'sessions',
                    'cells' => [
                        [
                            'title' => 'Non-vascular Intervention',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Assoc. Prof. Le Trong Binh', 'Assoc. Prof. Nguyen Thai Binh', 'Assoc. Prof. Nguyen Quoc Dung'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '13:00 - 13:20',
                                    'title' => 'Percutaneous Cholecystostomy: practical techniques',
                                    'speaker' => 'Assoc. Prof. Nakarin Inmutto',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:20 - 13:40',
                                    'title' => 'Controversies in the percutaneous transhepatic intervention for unresectable malignant hilar biliary obstruction',
                                    'speaker' => 'Assoc. Prof. Le Trong Binh',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:40 - 14:00',
                                    'title' => 'Percutaneous intra-abdominal and retroperitoneal foreign body removal',
                                    'speaker' => 'Nguyen Thai Binh, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:00 - 14:20',
                                    'title' => 'Primary result of drainage of abscess by ultrasound guiding at Chau Doc General Hospital',
                                    'speaker' => 'Le Thien Hoa, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:20 - 14:30',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'HCC',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Prof. Mai Trong Khoa', 'Assoc. Prof. Le Thanh Dung', 'Amanda Rigas, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '13:00 - 13:15',
                                    'title' => 'HCC 2026: Key Updates Every Interventional Radiologist Should Know',
                                    'speaker' => 'Amanda Rigas, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:15 - 13:30',
                                    'title' => 'The Interventionalist\'s Third Eye: Cone-Beam CT in the Era of Superselective TACE for HCC',
                                    'speaker' => 'Assoc. Prof. Kittipitch Bannangkoon',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:30 - 13:45',
                                    'title' => 'Radiation segmentectomy using Y90',
                                    'speaker' => 'Farah Gillan Irani, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:45 - 14:00',
                                    'title' => 'Intra-arterial Therapies for HCC in the Era of Systemic Therapies: Evolving Strategies and Techniques',
                                    'speaker' => 'Nguyen Duy Anh, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:00 - 14:15',
                                    'title' => 'Optimizing the treatment of intermediate-stage hepatocellular carcinoma through the combination of TACE and systemic therapy',
                                    'speaker' => 'Vo Ngoc Huan, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:15 - 14:30',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'Oral Presentation (English - Contest)',
                            'roles' => [
                                [
                                    'label' => 'Judges',
                                    'names' => ['Avi Beck, MD', 'Prof. Nicolas Stacoffe', 'Diamanto Rigas, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '13:00 - 13:10',
                                    'title' => 'Endovascular treatment of cerebral aneurysms using intrasaccular flow disruptors (WEB, LUNA...)',
                                    'speaker' => 'Nguyen Huynh Nhat Tuan, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:10 - 13:20',
                                    'title' => 'Initial outcomes of stent-assisted coiling with Pegasus stent for ruptured wide-necked cerebral aneurysms: A case series at Cho Ray Hospital',
                                    'speaker' => 'Le Van Khoa, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:20 - 13:30',
                                    'title' => 'Embolization of a left ventricular apical aneurysm: A case report',
                                    'speaker' => 'Nguyen Thai Binh, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:30 - 13:40',
                                    'title' => 'Endovascular treatment of foramen magnum dural arteriovenous fistulas (dAVFs): A report of two rare cases',
                                    'speaker' => 'Le Nhat Minh, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:40 - 13:50',
                                    'title' => 'Adrenal vein sampling: experience at People\'s Hospital 115',
                                    'speaker' => 'Do Quoc Huy, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:50 - 14:00',
                                    'title' => 'The "No-reflow" phenomenon after mechanical thrombectomy in patients with acute ischemic stroke',
                                    'speaker' => 'Nguyen Quang Hien, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:00 - 14:10',
                                    'title' => 'Endovascular Treatment of Cerebral Aneurysms at Quang Tri General Hospital',
                                    'speaker' => 'Phung Hung, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:10 - 14:20',
                                    'title' => 'Clinical outcomes of radiofrequency ablation (RFA) for the treatment of hemorrhoids at Gia Dinh General Hospital',
                                    'speaker' => 'Tran Ngoc Luong, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:20 - 14:30',
                                    'title' => 'Traumatic carotid-cavernous fistula with ipsilateral parent artery occlusion: What is the optimal treatment strategy?',
                                    'speaker' => 'Pham Dang Tu, MD',
                                    'break' => false,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'time' => '14.30 - 15.00',
                    'type' => 'break',
                    'session' => [
                        'title' => 'Tea Breaks',
                        'roles' => [],
                        'items' => [],
                    ],
                ],
                [
                    'time' => '15.30 - 17.00',
                    'type' => 'sessions',
                    'cells' => [
                        [
                            'title' => 'Embolization',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Prof. Hiroshi Kondo', 'Assoc. Prof. Le Trong Khoan', 'Nguyen Ngoc Cuong, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '15:30 - 15:50',
                                    'title' => 'Emergency IR for Hemorrhage Control',
                                    'speaker' => 'Prof. Hiroshi Kondo',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:50 - 16:10',
                                    'title' => 'Endovascular management of splenic artery aneurysms',
                                    'speaker' => 'Farah Gillan Irani, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:10 - 16:30',
                                    'title' => 'Updated management of resistant hypertension in end-stage renal disease patients via renal artery embolization',
                                    'speaker' => 'Assoc. Prof. Nguyen Xuan Hien',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:30 - 16:50',
                                    'title' => 'Visceral Arterial Pseudoaneurysms: Beyond Coils—What Are Our Options?',
                                    'speaker' => 'Pham Ngoc Minh Triet, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:50 - 17:00',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'Pelvic Intervention',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Assoc. Prof. Nguyen Xuan Hien', 'Avi Beck, MD', 'Assoc. Prof. Vo Tan Duc'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '15:30 - 15:45',
                                    'title' => 'Uterine Artery Embolization for fibroids/ adenomyosis/ obstetrical scenarios',
                                    'speaker' => 'Avi Beck, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:45 - 16:00',
                                    'title' => 'Endovascular intervention for men’s problems',
                                    'speaker' => 'Chun Yu Lin, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:00 - 16:15',
                                    'title' => 'Pelvic Vein Embolization for Pelvic Congestion Syndrome at Quang Tri General Hospital',
                                    'speaker' => 'Tran Minh Son, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:15 - 16:30',
                                    'title' => 'Tips and Trick embolization',
                                    'speaker' => 'Assoc. Prof. Nguyen Xuan Hien',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:30 - 16:45',
                                    'title' => 'Efficacy evaluation of endovascular intervention in the treatment of benign prostatic hyperplasia',
                                    'speaker' => 'Thi Van Gung, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:45 - 17:00',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'Stroke',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Assoc. Prof. Nguyen Huy Thang', 'Nguyen Duc Khang, MD', 'Assoc. Prof. Pham Minh Thong'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '15:30 - 15:45',
                                    'title' => 'Advanced Tips and Tricks for the Management of Complex Thrombectomy',
                                    'speaker' => 'Joseph Gammete, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:45 - 16:00',
                                    'title' => 'The optimal recanalisation therapy for acute ischemic stroke',
                                    'speaker' => 'Assoc. Prof. Nguyen Huy Thang',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:00 - 16:15',
                                    'title' => 'Endovascular thrombectomy for acute ischemic stroke: Updates from the 2026 AHA/ASA Guidelines',
                                    'speaker' => 'Nguyen Huynh Nhat Tuan, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:15 - 16:30',
                                    'title' => 'An 8-year review of endovascular thrombectomy for cerebral venous sinus thrombosis at Cho Ray Hospital',
                                    'speaker' => 'Tran Duc Hai, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:30 - 16:45',
                                    'title' => 'Updates on endovascular strategies for the treatment of chronic intracranial arterial stenosis',
                                    'speaker' => 'Pham Dang Tu, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:45 - 17:00',
                                    'title' => 'The role of endovascular intervention in the preoperative embolization of intracranial tumors',
                                    'speaker' => 'Le Nhat Minh, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => null,
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'time' => '18.30 - 21.30',
                    'type' => 'dinner',
                    'session' => [
                        'title' => 'Welcome Dinner',
                        'roles' => [],
                        'items' => [],
                    ],
                ],
            ],
        ],
        [
            'label' => 'Day 2',
            'date' => '17th October',
            'rooms' => ['Ha Noi', 'Da Nang', 'Sai Gon'],
            'rows' => [
                [
                    'time' => '08.00 - 09.30',
                    'type' => 'sessions',
                    'cells' => [
                        [
                            'title' => 'AVF/ PAD/ Peripheral Venous system',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Farah Gillan Irani, MD', 'Assoc. Prof. Le Trong Binh'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '08:00 - 08:15',
                                    'title' => 'One Patient, One Circulation: The Interplay Between PAD and ESRD',
                                    'speaker' => 'Amanda Rigas, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:15 - 08:30',
                                    'title' => 'PAD: procedural strategies: achieving true lumen access for iliac and femoropopliteal lesions without IVUS',
                                    'speaker' => 'Farah Gillan Irani, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:30 - 08:45',
                                    'title' => 'Endovascular management of LEDVT in cancer patients',
                                    'speaker' => 'Assoc. Prof. Le Trong Binh',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:45 - 09:00',
                                    'title' => 'Tips and Tricks to overcome in complex peripheral intervention',
                                    'speaker' => 'Assoc. Prof. Hoang Minh Loi',
                                    'break' => false,
                                ],
                                [
                                    'time' => '09:00 - 09:15',
                                    'title' => 'Endovascular treatment in patients with Diabetic Foot Ulcer',
                                    'speaker' => 'Luong Tuan Anh, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '09:15 - 09:30',
                                    'title' => 'Evaluation of clinical outcomes of digital subtraction angiography-guided endovascular intervention for stenosis and occlusion of arteriovenous fistulas (AVF) in hemodialysis patients at Chau Doc General Hospital',
                                    'speaker' => 'Phan Huy Hoang, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => null,
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'Pain Management',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Assoc. Prof. Bui Van Giang', 'Nguyen Anh Tuan, MD', 'Avi Beck, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '08:00 - 08:20',
                                    'title' => 'Pain Management (Image-guided nerve blocks and neurolysis, celiac plexus blocks, sphenopalatine blocks)',
                                    'speaker' => 'Avi Beck, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:20 - 08:40',
                                    'title' => 'Role of pterygopalatine ganglion blockage in treatment of facial pain',
                                    'speaker' => 'Nguyen Anh Tuan, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:40 - 09:00',
                                    'title' => 'Hypogastric Plexus Alcohol Neurolysis for Pain Management in Advanced Cancer',
                                    'speaker' => 'Trinh Tu Tam, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '09:00 - 09:20',
                                    'title' => 'Pain in microcrystalline arthropathies: diagnosis and minimally invasive interventional treatment',
                                    'speaker' => 'Prof. Bui Van Giang',
                                    'break' => false,
                                ],
                                [
                                    'time' => '09:20 - 09:30',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'DAVF/ Brain AVM',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Joseph Gammete, MD', 'Tran Quoc Tuan, MD', 'Assoc. Prof. Nguyen Trong Tuyen'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '08:00 - 08:15',
                                    'title' => 'Endovascular strategies for chronic subdural hematoma: Updates from the AHA/ASA consensus statement',
                                    'speaker' => 'Nguyen Huynh Nhat Tuan, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:15 - 08:30',
                                    'title' => 'Functional Venous Assessment in Transverse - Sigmoid Sinus DAVFs: How it guides Endovascular Treatment Strategy',
                                    'speaker' => 'Nguyen Quang Anh, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:30 - 08:45',
                                    'title' => 'Management of Chronic Subdural Hematoma: The Role of Endovascular Intervention and Surgery',
                                    'speaker' => 'Nguyen Minh Duc, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '08:45 - 09:00',
                                    'title' => 'Spinal vascular malformations: from diagnosis to management',
                                    'speaker' => 'Prof. Churojana Anchalee',
                                    'break' => false,
                                ],
                                [
                                    'time' => '09:00 - 09:15',
                                    'title' => 'Treatment of Pediatric Brain Arteriovenous Malformations: The Role of DSA and Embolization in a Personalized Strategy',
                                    'speaker' => 'Assoc. Prof. Pham Hong Duc',
                                    'break' => false,
                                ],
                                [
                                    'time' => '09:15 - 09:30',
                                    'title' => 'Vertebro-vertebral fistulas: when it is not easy',
                                    'speaker' => 'Prof. Churojana Anchalee',
                                    'break' => false,
                                ],
                                [
                                    'time' => null,
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'time' => '09.30 - 10.00',
                    'type' => 'break',
                    'session' => [
                        'title' => 'Tea Breaks',
                        'roles' => [],
                        'items' => [],
                    ],
                ],
                [
                    'time' => '10.00 - 11.30',
                    'type' => 'shared',
                    'session' => [
                        'title' => 'Opening Ceremony & Plenary Session',
                        'roles' => [
                            [
                                'label' => 'Chairs',
                                'names' => ['Prof. Pham Minh Thong', 'Nguyen Dinh Luan, MD', 'Assoc. Prof. Le Thanh Dung'],
                            ],
                        ],
                        'items' => [
                            [
                                'time' => '10:00 - 10:30',
                                'title' => 'Opening Ceremony',
                                'speaker' => null,
                                'break' => true,
                            ],
                            [
                                'time' => '10:30 - 10:50',
                                'title' => 'AI & IR',
                                'speaker' => 'Assoc. Prof. Hoang Minh Loi',
                                'break' => false,
                            ],
                            [
                                'time' => '10:50 - 11:10',
                                'title' => 'Global Training: Beyond Case Numbers: Competency-Based Training in Interventional Radiology',
                                'speaker' => 'Amanda Rigas, MD (SIR)',
                                'break' => false,
                            ],
                            [
                                'time' => '11:10 - 11:30',
                                'title' => 'Role of IR in Pediatric',
                                'speaker' => 'Prof. Murthy Chennapragada',
                                'break' => false,
                            ],
                        ],
                    ],
                ],
                [
                    'time' => '11.30 - 12.30',
                    'type' => 'lunch',
                    'cells' => [
                        [
                            'title' => 'Lunch symposium',
                            'roles' => [],
                            'items' => [],
                        ],
                        [
                            'title' => 'Lunch symposium - Merit',
                            'roles' => [],
                            'items' => [],
                        ],
                        [
                            'title' => 'Lunch symposium',
                            'roles' => [],
                            'items' => [],
                        ],
                    ],
                ],
                [
                    'time' => '13.00 - 14.30',
                    'type' => 'sessions',
                    'cells' => [
                        [
                            'title' => 'Innovations',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Assoc. Prof. Le Thanh Dung', 'Nguyen Dinh Luan, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '13:00 - 13:15',
                                    'title' => 'The Role of Interventional Radiology in Orthopedic and Musculoskeletal Disorders',
                                    'speaker' => 'Joris Lavigne, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:15 - 13:30',
                                    'title' => 'Reversible electroporation for AVMs: the new gold standard?',
                                    'speaker' => 'Martin Krauss, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:30 - 13:45',
                                    'title' => 'The principle of irreversible electroporation',
                                    'speaker' => 'Prof. Huang Kai Wen',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:45 - 14:00',
                                    'title' => 'Clinic pull, technology push - Innovations for Interventions',
                                    'speaker' => 'Prof. Xiang Jun',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:00 - 14:15',
                                    'title' => 'Interventional oncology for children - what\'s different and what\'s new?',
                                    'speaker' => 'Kevin Fung, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:15 - 14:30',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'Ablation',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Prof. Huang Kai Wen', 'Ngo Le Lam, MD', 'Chun Yu Lin, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '13:00 - 13:15',
                                    'title' => 'Renal cryoablation',
                                    'speaker' => 'Avi Beck, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:15 - 13:30',
                                    'title' => 'Combined embolization and ablation therapy in liver and kidney',
                                    'speaker' => 'Chun Yu Lin, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:30 - 13:45',
                                    'title' => 'Cryoablation of lung tumor',
                                    'speaker' => 'Prof. Masanori Inoue',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:45 - 14:00',
                                    'title' => 'Percutaneous Thermal Ablation in the Management of Bone Metastases',
                                    'speaker' => 'Prof. Nicolas Stacoffe',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:00 - 14:15',
                                    'title' => 'Microwave ablation for uterine fibroid',
                                    'speaker' => 'Tran Quy Tuong, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:15 - 14:30',
                                    'title' => 'Microwave Ablation for Uterine Fibroids: From Patient Selection to Technical Optimization',
                                    'speaker' => 'Nguyen Duc Tinh, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => null,
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'Aneurysm/ Miscellaneous',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Assoc. Prof. Anchalee Churojana', 'Nguyen Huynh Nhat Tuan, MD', 'Tran Quoc Tuan, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '13:00 - 13:15',
                                    'title' => 'Management of Aneurysm by FDS',
                                    'speaker' => 'Nguyen Huynh Nhat Tuan, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:15 - 13:30',
                                    'title' => 'Flow diverters in the treatment of intracranial aneurysms',
                                    'speaker' => 'Tran Quoc Tuan, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:30 - 13:45',
                                    'title' => 'Transradial access for neurointerventions: Updates on recent advances',
                                    'speaker' => 'Tran Duc Hai, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '13:45 - 14:00',
                                    'title' => 'Middle meningeal artery embolization for the treatment of chronic subdural hematoma: updated recommendations and practical considerations',
                                    'speaker' => 'Tran Quoc Tuan, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:00 - 14:20',
                                    'title' => 'Record live case',
                                    'speaker' => 'Acandis',
                                    'break' => false,
                                ],
                                [
                                    'time' => '14:20 - 14:30',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'time' => '14.30 - 15.00',
                    'type' => 'break',
                    'session' => [
                        'title' => 'Tea Breaks',
                        'roles' => [],
                        'items' => [],
                    ],
                ],
                [
                    'time' => '15.00 - 16.30',
                    'type' => 'sessions',
                    'cells' => [
                        [
                            'title' => 'Consensus for IR management of portal hypertension',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Assoc. Prof. Le Thanh Dung', 'Nguyen Dinh Luan, MD', 'Assoc. Prof. Vo Duy Thong', 'Ho Dang Quy Dung, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '15:00 - 15:15',
                                    'title' => 'B-RTO',
                                    'speaker' => 'Prof. Masanori Inoue',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:15 - 15:30',
                                    'title' => 'Current Status of TIPS Procedure in Taiwan',
                                    'speaker' => 'Wu Chih Horng, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:30 - 15:45',
                                    'title' => 'Record live case',
                                    'speaker' => 'Gore',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:45 - 16:00',
                                    'title' => 'Video',
                                    'speaker' => 'Assoc. Prof. Nguyen Trong Tuyen',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:00 - 16:15',
                                    'title' => 'Video',
                                    'speaker' => 'Nguyen Tan Tai, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:15 - 16:30',
                                    'title' => 'Consensus (Version 2)',
                                    'speaker' => 'Tran Doan Khac Viet, MD | Nguyen Tan Tai, MD',
                                    'break' => false,
                                ],
                            ],
                        ],
                        [
                            'title' => 'Vascular malformations',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Nguyen Huu Kim An, MD', 'Martin Krauss, MD', 'Nguyen Ngoc Cuong, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '15:00 - 15:20',
                                    'title' => 'Systematic review of efficacy and safety of Sirolimus in the treatment of congenital lymphatic malformation',
                                    'speaker' => 'Nguyen Huu Kim An, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:20 - 15:40',
                                    'title' => 'Bones AVM: Recognition and strategic to embolize',
                                    'speaker' => 'Nguyen Ngoc Cuong, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:40 - 16:00',
                                    'title' => 'Transvenous approach for the treatment of brain arteriovenous malformations (bAVMs): Updates from the TATAM 2025 study',
                                    'speaker' => 'Le Van Khoa, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:00 - 16:20',
                                    'title' => 'Reversible electroporation for slow-flow vascular malformations: indication, probe selection, technique and outcomes',
                                    'speaker' => 'Martin Krauss, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:20 - 16:30',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'Technician-Nurse',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Assoc. Prof. Le Thanh Thao', 'Assoc. Prof. Dang Vinh Hiep', 'Technician Thai Van Loc'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '15:00 - 15:15',
                                    'title' => 'Building a pediatric IR service - the road less travelled',
                                    'speaker' => 'Kevin Fung, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:15 - 15:30',
                                    'title' => 'Evaluation of hemostatic efficacy and complications of radial artery mechanical compression following percutaneous coronary intervention at the endovascular intervention unit of HCM UMC',
                                    'speaker' => 'Technician Tran Ba Khoa',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:30 - 15:45',
                                    'title' => 'Optimization of A 3.0T MRI Protocol to improve image quality in patients after endovascular Coil embolization of intracranial aneurysms',
                                    'speaker' => 'Technician Le Thanh Phong',
                                    'break' => false,
                                ],
                                [
                                    'time' => '15:45 - 16:00',
                                    'title' => 'Education and Clinical Training of Interventional Radiologic Technologists in Taiwan',
                                    'speaker' => 'Technician Liu Yu-Ping',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:00 - 16:15',
                                    'title' => 'Advancing Beyond Conventional Competency: Cultivating Multidimensional, Future-Ready Competencies in Interventional Technologists',
                                    'speaker' => 'Technician Lu Yen-Ho',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:15 - 16:30',
                                    'title' => 'The Pivotal Role of Interventional Radiology Nurses in Acute Endovascular Thrombectomy (EVT): Workflow Standardization, Patient Safety, and Quality Management',
                                    'speaker' => 'Technician Chen Yin-Ting',
                                    'break' => false,
                                ],
                                [
                                    'time' => null,
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'time' => '16.30 - 17.30',
                    'type' => 'sessions',
                    'cells' => [
                        [
                            'title' => 'Oncological Intervention and Neurointervention - UIH AVIVA',
                            'roles' => [],
                            'items' => [
                                [
                                    'time' => '16:30 - 16:45',
                                    'title' => 'Cutting-edge Progress in Oncological Interventional Radiology',
                                    'speaker' => 'Zhang Wen MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:45 - 17:00',
                                    'title' => 'Y90 procedure under AVIVA',
                                    'speaker' => 'Rio Hermawan MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '17:00 - 17:15',
                                    'title' => 'Advanced CTO Procedures under AVIVA',
                                    'speaker' => 'Arif Sejati MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '17:15 - 17:30',
                                    'title' => 'Advanced Clinical Practice in Neurointervention',
                                    'speaker' => 'Zhang Wen MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => null,
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'M&M',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Prof. Masanori Inoue', 'Ngo Le Lam, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '16:30 - 16:40',
                                    'title' => 'Managing Difficult IR Cases in a Hybrid OR',
                                    'speaker' => 'Wu Chih Horng, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:40 - 16:50',
                                    'title' => 'My nightmare cases at M&M session',
                                    'speaker' => 'Prof. Masanori Inoue',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:50 - 17:00',
                                    'title' => 'Catheter-directed thrombectomy of pulmonary embolism using a 16F sheath — Challenges and troubleshooting: A case report at Hanoi Medical University Hospital',
                                    'speaker' => 'Nguyen Thai Binh, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '17:00 - 17:10',
                                    'title' => 'Complications of transjugular intrahepatic portosystemic shunt (TIPS) interventions',
                                    'speaker' => 'Tran Quang Luc, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '17:10 - 17:20',
                                    'title' => 'Management of HCC, learning from failures',
                                    'speaker' => 'Ngo Le Lam, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '17:20 - 17:30',
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                        [
                            'title' => 'MSK',
                            'roles' => [
                                [
                                    'label' => 'Chairs',
                                    'names' => ['Prof. Nicolas Stacoffe', 'Nguyen Truong Giang, MD', 'Nguyen Ngoc Trang, MD'],
                                ],
                            ],
                            'items' => [
                                [
                                    'time' => '16:30 - 16:50',
                                    'title' => 'Transarterial Microembolization (TAME) for Musculoskeletal Conditions',
                                    'speaker' => 'Panat Nisityotakul, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => '16:50 - 17:10',
                                    'title' => 'Pushing the Boundaries of Percutaneous Osteosynthesis in Interventional Radiology',
                                    'speaker' => 'Prof. Nicolas Stacoffe',
                                    'break' => false,
                                ],
                                [
                                    'time' => '17:10 - 17:30',
                                    'title' => 'Interventional radiology for pain management in knee osteoarthritis',
                                    'speaker' => 'Nguyen Truong Giang, MD',
                                    'break' => false,
                                ],
                                [
                                    'time' => null,
                                    'title' => 'Discussion',
                                    'speaker' => null,
                                    'break' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'time' => '18.30 - 21.30',
                    'type' => 'dinner',
                    'session' => [
                        'title' => 'Gala Dinner',
                        'roles' => [],
                        'items' => [],
                    ],
                ],
            ],
        ],
    ],
];
