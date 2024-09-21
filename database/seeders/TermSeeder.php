<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_terms')->insert([
            [
                'term' => 'Artificial Intelligence',
                'description' => 'Covers all areas of AI except Vision, Robotics, Machine Learning, Multiagent Systems, and Computation and Language (Natural Language Processing), which have separate subject areas. In particular, includes Expert Systems, Theorem Proving (although this may overlap with Logic in Computer Science), Knowledge Representation, Planning, and Uncertainty in AI.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Computation and Language',
                'description' => 'Covers natural language processing. Roughly includes material in ACM Subject Class I.2.7. Note that work on artificial languages (programming languages, logics, formal systems) that does not explicitly address natural-language issues broadly construed (natural-language processing, computational linguistics, speech, text retrieval, etc.) is not appropriate for this area.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Computer Vision and Pattern Recognition',
                'description' => 'Covers image processing, computer vision, pattern recognition, and scene understanding. Roughly includes material in ACM Subject Classes I.2.10, I.4, and I.5.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Databases',
                'description' => 'Covers database management, datamining, and data processing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Data Structures and Algorithms',
                'description' => 'Covers data structures and analysis of algorithms.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Human-Computer Interaction',
                'description' => 'Covers human factors, user interfaces, and collaborative computing. Roughly includes material in ACM Subject Classes H.1.2 and all of H.5, except for H.5.1, which is more likely to have Multimedia as the primary subject area.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Machine Learning',
                'description' => 'Papers on all aspects of machine learning research (supervised, unsupervised, reinforcement learning, bandit problems, and so on) including also robustness, explanation, fairness, and methodology. cs.LG is also an appropriate primary category for applications of machine learning methods.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Multiagent Systems',
                'description' => 'Covers multiagent systems, distributed artificial intelligence, intelligent agents, coordinated interactions. and practical applications.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Networking and Internet Architecture',
                'description' => 'Covers all aspects of computer communication networks, including network architecture and design, network protocols, and internetwork standards (like TCP/IP). Also includes topics, such as web caching, that are directly relevant to Internet architecture and performance.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Software Engineering',
                'description' => 'Covers design tools, software metrics, testing and debugging, programming environments, etc. Roughly includes material in all of ACM Subject Classes D.2, except that D.2.4 (program verification) should probably have Logics in Computer Science as the primary subject area.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
