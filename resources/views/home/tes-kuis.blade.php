<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl shadow-lg mb-4">
                    <i class="fas fa-clipboard-check text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-3">Kuis Kesehatan Mental</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Jawab semua pertanyaan di bawah ini dengan jujur. Hasil ini akan membantu Anda memahami kondisi kesehatan mental Anda.
                </p>
                <div class="mt-4 inline-flex items-center px-4 py-2 bg-blue-100 rounded-full">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    <span class="text-sm font-medium text-blue-800">Waktu pengerjaan: ±5 menit</span>
                </div>
            </div>

            <!-- Quiz Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-700 px-8 py-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                            <i class="fas fa-brain text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Self-Assessment</h2>
                            <p class="text-cyan-100 text-sm">Evaluasi diri untuk kesehatan mental yang lebih baik</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form method="POST" action="{{ route('kuis.submit') }}" onsubmit="return validateForm()" class="p-8">
                    @csrf

                    <!-- Question 1 -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                        <p class="text-lg font-semibold text-gray-900 mb-4 flex items-start">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyan-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">1</span>
                            Seberapa sering Anda merasa cemas atau khawatir dalam dua minggu terakhir?
                        </p>
                        <div class="space-y-3 ml-11">
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q1" value="0" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Tidak pernah</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q1" value="1" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Beberapa hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q1" value="2" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Lebih dari setengah hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q1" value="3" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Hampir setiap hari</span>
                            </label>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                        <p class="text-lg font-semibold text-gray-900 mb-4 flex items-start">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyan-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">2</span>
                            Seberapa sering Anda merasa sedih atau tertekan dalam dua minggu terakhir?
                        </p>
                        <div class="space-y-3 ml-11">
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q2" value="0" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Tidak pernah</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q2" value="1" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Beberapa hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q2" value="2" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Lebih dari setengah hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q2" value="3" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Hampir setiap hari</span>
                            </label>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                        <p class="text-lg font-semibold text-gray-900 mb-4 flex items-start">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyan-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">3</span>
                            Seberapa sering Anda merasa lelah atau tidak berenergi dalam dua minggu terakhir?
                        </p>
                        <div class="space-y-3 ml-11">
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q3" value="0" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Tidak pernah</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q3" value="1" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Beberapa hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q3" value="2" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Lebih dari setengah hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q3" value="3" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Hampir setiap hari</span>
                            </label>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                        <p class="text-lg font-semibold text-gray-900 mb-4 flex items-start">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyan-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">4</span>
                            Seberapa sering Anda mengalami kesulitan tidur atau tidur berlebihan dalam dua minggu terakhir?
                        </p>
                        <div class="space-y-3 ml-11">
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q4" value="0" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Tidak pernah</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q4" value="1" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Beberapa hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q4" value="2" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Lebih dari setengah hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q4" value="3" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Hampir setiap hari</span>
                            </label>
                        </div>
                    </div>

                    <!-- Question 5 -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                        <p class="text-lg font-semibold text-gray-900 mb-4 flex items-start">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyan-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">5</span>
                            Seberapa sering Anda merasa tidak tertarik atau tidak menikmati aktivitas yang biasanya Anda sukai dalam dua minggu terakhir?
                        </p>
                        <div class="space-y-3 ml-11">
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q5" value="0" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Tidak pernah</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q5" value="1" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Beberapa hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q5" value="2" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Lebih dari setengah hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q5" value="3" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Hampir setiap hari</span>
                            </label>
                        </div>
                    </div>

                    <!-- Question 6 -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                        <p class="text-lg font-semibold text-gray-900 mb-4 flex items-start">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyan-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">6</span>
                            Seberapa sering Anda merasa gugup, gelisah, atau tegang dalam dua minggu terakhir?
                        </p>
                        <div class="space-y-3 ml-11">
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q6" value="0" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Tidak pernah</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q6" value="1" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Beberapa hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q6" value="2" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Lebih dari setengah hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q6" value="3" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Hampir setiap hari</span>
                            </label>
                        </div>
                    </div>

                    <!-- Question 7 -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                        <p class="text-lg font-semibold text-gray-900 mb-4 flex items-start">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyan-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">7</span>
                            Seberapa sering Anda mengalami kesulitan berkonsentrasi pada hal-hal, seperti membaca koran atau menonton televisi dalam dua minggu terakhir?
                        </p>
                        <div class="space-y-3 ml-11">
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q7" value="0" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Tidak pernah</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q7" value="1" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Beberapa hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q7" value="2" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Lebih dari setengah hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q7" value="3" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Hampir setiap hari</span>
                            </label>
                        </div>
                    </div>

                    <!-- Question 8 -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                        <p class="text-lg font-semibold text-gray-900 mb-4 flex items-start">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyan-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">8</span>
                            Seberapa sering Anda merasa bahwa Anda tidak berharga atau merasa bersalah dalam dua minggu terakhir?
                        </p>
                        <div class="space-y-3 ml-11">
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q8" value="0" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Tidak pernah</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q8" value="1" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Beberapa hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q8" value="2" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Lebih dari setengah hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q8" value="3" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Hampir setiap hari</span>
                            </label>
                        </div>
                    </div>

                    <!-- Question 9 -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                        <p class="text-lg font-semibold text-gray-900 mb-4 flex items-start">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyan-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">9</span>
                            Seberapa sering Anda berpikir bahwa Anda lebih baik mati atau ingin menyakiti diri sendiri dengan cara tertentu dalam dua minggu terakhir?
                        </p>
                        <div class="space-y-3 ml-11">
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q9" value="0" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Tidak pernah</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q9" value="1" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Beberapa hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q9" value="2" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Lebih dari setengah hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q9" value="3" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Hampir setiap hari</span>
                            </label>
                        </div>
                    </div>

                    <!-- Question 10 -->
                    <div class="mb-8 p-6 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                        <p class="text-lg font-semibold text-gray-900 mb-4 flex items-start">
                            <span class="flex-shrink-0 w-8 h-8 bg-cyan-600 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">10</span>
                            Seberapa sering Anda merasa sulit untuk mengontrol perasaan marah atau frustrasi dalam dua minggu terakhir?
                        </p>
                        <div class="space-y-3 ml-11">
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q10" value="0" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Tidak pernah</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q10" value="1" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Beberapa hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q10" value="2" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Lebih dari setengah hari</span>
                            </label>
                            <label class="flex items-center p-3 bg-white rounded-lg border-2 border-gray-200 hover:border-cyan-400 cursor-pointer transition-all duration-200 hover:shadow-md">
                                <input type="radio" name="q10" value="3" class="mr-3 w-5 h-5 text-cyan-600 focus:ring-cyan-500">
                                <span class="text-gray-700">Hampir setiap hari</span>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end pt-6 border-t border-gray-200">
                        <button type="submit" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-xl hover:shadow-lg hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Kuis
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-blue-50 rounded-xl p-6 border border-blue-100">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-base font-semibold text-blue-900 mb-2">Privasi & Keamanan</h4>
                        <p class="text-sm text-blue-800">
                            Jawaban Anda akan dijaga kerahasiaannya dan hanya digunakan untuk evaluasi kesehatan mental Anda. Hasil kuis ini bukan diagnosis medis, namun dapat membantu Anda memahami kondisi mental Anda lebih baik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            const questions = 10;
            let unanswered = [];
            
            for (let i = 1; i <= questions; i++) {
                const radios = document.getElementsByName('q' + i);
                let isChecked = false;
                
                for (const radio of radios) {
                    if (radio.checked) {
                        isChecked = true;
                        break;
                    }
                }
                
                if (!isChecked) {
                    unanswered.push(i);
                }
            }
            
            if (unanswered.length > 0) {
                alert('Silakan jawab semua pertanyaan sebelum mengirim. Pertanyaan yang belum dijawab: ' + unanswered.join(', '));
                // Scroll to first unanswered question
                const firstUnanswered = unanswered[0];
                const questionElement = document.querySelector(`input[name="q${firstUnanswered}"]`).closest('.mb-8');
                questionElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return false;
            }
            
            return true;
        }
    </script>
</x-guest-layout>
