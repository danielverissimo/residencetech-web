require 'json'
require 'yaml'

VAGRANTFILE_API_VERSION = "2"

firesteadYamlPath = File.expand_path("./firestead/config.yaml")
afterScriptPath = File.expand_path("./firestead/after.sh")
aliasesPath = File.expand_path("./firestead/aliases")
composerConfigPath = File.expand_path("./auth.json")
settings = YAML::load(File.read(firesteadYamlPath))

require_relative 'firestead/config.rb'

# settings["provider"] = "vmware_fusion"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
	if File.exists? aliasesPath then
		config.vm.provision "file", source: aliasesPath, destination: "~/.bash_aliases"
	end

	Homestead.configure(config, settings)

	config.vm.synced_folder ".", "/vagrant",
		id: "core",
		:nfs => true,
		:mount_options => ["nolock,vers=3,udp,noatime"]

	if File.exists? composerConfigPath then
		config.vm.provision "file", source: composerConfigPath, destination: "~/.composer/auth.json"
	end

	if File.exists? afterScriptPath then
		config.vm.provision "shell", path: afterScriptPath
	end

	config.vm.provision "shell" do |s|
		s.inline = "su - vagrant -c 'cd /vagrant && cp .env.example .env && composer install'"
	end
end
